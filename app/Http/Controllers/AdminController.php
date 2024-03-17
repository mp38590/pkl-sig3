<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VariabelPenilaian;
use App\Models\Realisasi;
use App\Models\Dokumen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showDashboardAdmin()
    {
        $jumlah_dokumen = [];
        $username = Auth::user()->username;
        $user = User::where('username', $username)->first();
        $level = $user->level;

        $jumlah_dokumen = Dokumen::where('nama_dokumen', '!=', null)->where('inserted_by', $username)
                                    ->count();
                                    
        $existingDokumen = Dokumen::first();
        $created_at = optional($existingDokumen)->created_at;
        $latestTimestampDokumen = Dokumen::where('nama_dokumen', '!=', null)
                ->where('inserted_by', $username)
                ->max('created_at');
        $tambah_dokumen = Dokumen::where('nama_dokumen', '!=', null)
                                    ->where('inserted_by', $username)
                                    ->where('created_at', $latestTimestampDokumen)
                                    ->count();
        $presentase = ($jumlah_dokumen > 0) ? ($tambah_dokumen / ($jumlah_dokumen)) * 100 : 0;
        $presentase = round($presentase, 4);

        $latestTimestampVerif = Dokumen::where('nama_dokumen', '!=', null)
                                        ->max('created_at');

        $verifikasi = Dokumen::where('nama_dokumen', '!=', null)
                                ->where('status', '=', 'not approve')
                                ->where('flag_delete', '=', 0)
                                ->where('created_at', $latestTimestampVerif)
                                ->count();
        
        $jumlah_verifikasi = Dokumen::where('nama_dokumen', '!=', null)
                                    ->where('inserted_by', '!=', null)
                                    ->where('status', '=', 'not approve')
                                    ->count();

        $presentaseVerifikasi = ($jumlah_verifikasi > 0) ? ($verifikasi / ($jumlah_verifikasi)) * 100 : 0;
        $presentaseVerifikasi = round($presentaseVerifikasi, 4);

        $jumlah_pengguna = User::count();
        $jumlah_karyawan = User::where('level', '=', 'Karyawan')->count();
        $jumlah_admin = User::where('level', '=', 'Admin')->count();

        $latestDatePengguna = User::select(DB::raw("MAX(DATE(created_at)) as latest_date"))->value('latest_date');

        $tambah_pengguna = User::whereDate('created_at', $latestDatePengguna)->count();

        $presentasePengguna = ($jumlah_pengguna > 0) ? ($tambah_pengguna / ($jumlah_pengguna)) * 100 : 0;

        $data = Dokumen::select(DB::raw("EXTRACT(MONTH FROM created_at) as month"), DB::raw('COUNT(*) as total'))
                        ->where('nama_dokumen', '!=', null)
                        ->where('inserted_by', $username)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        $labels = $data->pluck('month');
        $values = $data->pluck('total');

        $approve = Dokumen::select(DB::raw("EXTRACT(MONTH FROM updated_at) as month"), DB::raw('COUNT(*) as jumlah'))
                    ->whereNotNull('nama_dokumen')
                    ->where('status', '=', 'approve')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

        $label = $approve->pluck('month');
        $value = $approve->pluck('jumlah');

        $latestTimestampRealisasi = Realisasi::where('nilai', '!=', null)
                                                ->max('updated_at');

        $nilai_dokumen = Realisasi::where('nilai', '!=', null)
                                    ->get();

        $nilai = Realisasi::select(DB::raw("kode_penilaian as kode_penilaian"), DB::raw("SUM(nilai) as total_nilai"))
                            ->where('flag_delete', '=', 0)
                            ->whereIn('updated_at', function($query) {
                                $query->select(DB::raw('MAX(updated_at)'))
                                    ->from('realisasi')
                                    ->whereRaw('realisasi.kode_penilaian = kode_penilaian')
                                    ->where('flag_delete', '=', 0)
                                    ->groupBy('kode_penilaian');
                            })
                            ->groupBy('kode_penilaian')
                            ->orderBy('kode_penilaian')
                            ->get();
        $l = $nilai->pluck('total_nilai');
        $m = $nilai->pluck('kode_penilaian');

        return view('admin.dashboard_admin', compact('user', 'jumlah_dokumen', 'presentase', 'verifikasi', 'jumlah_verifikasi', 'presentaseVerifikasi', 'jumlah_pengguna', 'jumlah_karyawan', 'jumlah_admin',
                                                        'tambah_pengguna', 'presentasePengguna', 'labels', 'values', 'label', 'value', 'tambah_dokumen', 'l', 'm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailAdmin(Request $request)
    {
        $search = $request->get('search');

        $detail_dokumen = DB::table('realisasi')
            ->leftJoin('variabel_penilaian', function($join) {
                $join->on('realisasi.id_variabel_penilaian', '=', 'variabel_penilaian.id_variabel_penilaian')
                     ->where('variabel_penilaian.flag_delete', '=', 0);
            })
            ->where('realisasi.flag_delete', '=', 0)
            ->select('realisasi.*', 'variabel_penilaian.versi', 'variabel_penilaian.nilai_maksimal')
            ->orderBy('realisasi.id_variabel_penilaian')
            ->distinct();

        if ($search) {
            $detail_dokumen->where(function($query) use ($search) {
                // Check if the search term is an integer
                if (ctype_digit($search)) {
                    // If the search term is an integer, search only in the 'detail' column of 'realisasi'
                    $query->where('realisasi.nilai', 'like', '%' . $search . '%')
                        ->orWhere('variabel_penilaian.versi', 'like', '%' . $search . '%')
                        ->orWhere('variabel_penilaian.nilai_maksimal', 'like', '%' . $search . '%');
                } else {
                    // If the search term is not an integer, search in all relevant columns
                    $query->where('realisasi.tahun', 'like', '%' . $search . '%')
                        ->orWhere('realisasi.kode_penilaian', 'like', '%' . $search . '%')
                        ->orWhere('realisasi.item_penilaian', 'like', '%' . $search . '%')
                        ->orWhere('realisasi.deskripsi_item_penilaian', 'like', '%' . $search . '%');
                }
            });
        }    
            
        $detail_dokumen = $detail_dokumen->paginate(5, ['*'], 'page', request()->page);

        $existingDokumen = Dokumen::first();
        $dokumen = optional($existingDokumen)->id_variabel_penilaian;
    
        // Check if data is empty
        if ($detail_dokumen->isEmpty()) {
            return view('admin.detail_dokumen', compact('detail_dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        if (!$dokumen) {
            return view('admin.detail_dokumen', compact('dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
    
        return view('admin.detail_dokumen', compact('detail_dokumen', 'dokumen'));
    }

    public function tambahFileAdmin($id_variabel_penilaian)
    {
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        return view('admin.upload_dokumen', compact('dokumen', 'variabelPenilaian', 'realisasi'));
    }
    
    public function uploadFileAdmin(Request $request, $id_variabel_penilaian)
    {
        $loggedInUser = Auth::user();

        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        
        // $existingData = VariabelPenilaian::first();  // Change YourModel to the actual model you are using
        // $item_penilaian = $existingData->item_penilaian;

        // $dokumen = Dokumen::where('item_penilaian', $item_penilaian)->first();

        $request->validate([
            'file.*' => 'required|mimes:pdf',
        ], [
            'file.*.required' => 'Nama Dokumen harus dimasukkan',
            'file.*.mimes' => 'Dokumen harus dalam format pdf',
        ]);

        $dataRealisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)->get();

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $pdf) {
                $pdfName = $pdf->getClientOriginalName();
                $pdf->move(public_path('uploads/file'), $pdfName);
        
                // Check if the Dokumen with the given ID already has a document
                $existingDokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        
                if (!$existingDokumen->nama_dokumen) {
                    // If the Dokumen does not have a document, update the existing record
                    $existingDokumen->nama_dokumen = $pdfName;
                    $existingDokumen->update(['inserted_by' => $loggedInUser->username]);
                    $existingDokumen->update(['updated_by' => $loggedInUser->username]);
                    $existingDokumen->save();
                } else {
                    // If the Dokumen already has a document, create a new record
                    $newDokumen = new Dokumen;
                    $newDokumen->id_variabel_penilaian = $request->id_variabel_penilaian;
                    $newDokumen->kode_penilaian = $existingDokumen->kode_penilaian;
                    $newDokumen->item_penilaian = $existingDokumen->item_penilaian;
                    $newDokumen->deskripsi_item_penilaian = $existingDokumen->deskripsi_item_penilaian;
                    $newDokumen->status = 'not approve';
                    $newDokumen->inserted_by = $loggedInUser->username;
                    $newDokumen->updated_by = $loggedInUser->username;
                    $newDokumen->flag_delete = 0;
                    $newDokumen->nama_dokumen = $pdfName;
        
                    $newDokumen->save();
                }
            }
        }        

        // Pass $dokumen to the view
        return redirect()->route('detail_dokumen_admin')->with('success', 'File dokumen berhasil dimasukkan dan ditambahkan dalam database')->with('dokumen', $dokumen);
    }

    public function showDokumenAdmin($id_variabel_penilaian)
    {
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->where('flag_delete', '=', 0)->paginate(5);
        $variabelPenilaian = VariabelPenilaian::find($id_variabel_penilaian);
        $realisasi = Realisasi::find($id_variabel_penilaian);

        if ($dokumen->isEmpty()) {
            return view('admin.view_dokumen', compact('dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        if (!$variabelPenilaian) {
            return view('admin.view_dokumen')->with('error', 'Tidak Ada Variabel Penilaian yang ditemukan');
        }
        if (!$realisasi) {
            return view('admin.view_dokumen')->with('error', 'Tidak Ada Realisasi yang ditemukan');
        }

        return view('admin.view_dokumen', compact('dokumen', 'variabelPenilaian', 'realisasi'));
    }

    public function lihatFileAdmin($id_variabel_penilaian, $nama_dokumen)
    {
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->where('nama_dokumen', $nama_dokumen)->first();

        if (!$dokumen) {
            abort(404); // Handle jika dokumen tidak ditemukan
        }

        $filePath = public_path('uploads/file/' . $dokumen->nama_dokumen);

        return response()->file($filePath);
    }

    public function editAdmin($id_variabel_penilaian)
    {
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)
                            ->first();
    
        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)
                                ->first();

        $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)
                                                ->first();

        if ($dokumen || $variabelPenilaian || $realisasi->isEmpty()) {
            return view('admin.edit_skor', compact('dokumen', 'variabelPenilaian', 'realisasi'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }

        return view('admin.edit_skor', compact('variabelPenilaian', 'realisasi', 'dokumen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     */
    public function updateAdmin(Request $request, $id_variabel_penilaian)
    {
        $loggedInUser = Auth::user();

        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)->first();

        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)
                            ->first();

        $request->validate([
            'nilai' => 'required|min:1|max:5',
        ], [
            'nilai.required' => 'Nilai final harus dimasukkan',
        ]);

        // Ubah nilai kolom sesuai dengan data yang diterima dari $request
        $realisasi->update(['nilai' => $request->input('nilai')]);

        // Set informasi pengguna yang menyimpan data
        $realisasi->update(['updated_by' => $loggedInUser->username]);

        // Berikan respons sukses atau redirect sesuai kebutuhan Anda
        return redirect()->route('detail_dokumen_admin')->with('success', 'Skor maksimal dan final berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function showProfileAdmin($id){
        $user = User::find($id);

        return view('admin.profile', compact('user'));
    }

    public function editProfileAdmin($id){
        $user = User::find($id);

        return view('admin.profile', compact('user'));
    }

    public function updateProfileAdmin(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $request->validate([
            'name' => 'required|min:1|max:255',
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama pengguna harus dimasukkan',
            'file.required' => 'Foto profil pengguna harus dimasukkan',
            'file.mimes' => 'Foto profil pengguna harus dalam format JPG/PNG',
        ]);

        // Ubah nilai kolom sesuai dengan data yang diterima dari $request
        $user->name = $request->input('name');

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profiles'), $imageName);
            $user->foto = $imageName;
        }

        $user->inserted_by = $request->input('username');
        $user->updated_by = $request->input('username');

        $user->save();

        // Berikan respons sukses atau redirect sesuai kebutuhan Anda
        return redirect()->route('show_profile_admin', ['id' => $user->id])->with('success', 'Data pribadi pengguna berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function editDataProfileAdmin($id){
        $user = User::find($id);

        return view('admin.edit_data_profile', compact('user'));
    }

    public function updateDataProfileAdmin(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $request->validate([
            'username' => 'required|min:1|max:255',
            'nik' => 'required|min:1|max:20',
            'email' => 'required|min:1|max:255|email',
            'no_hp' => 'required|min:11|max:13',
            'alamat_rumah' => 'required|min:1|max:255',
            'jabatan' => 'required|min:1|max:255',
            'no_rekening' => 'required|min:1|max:20',
        ], [
            'username.required' => 'Username pengguna harus dimasukkan',
            'nik.required' => 'NIK pengguna harus dimasukkan',
            'email.required' => 'Email pengguna harus dimasukkan',
            'no_hp.required' => 'Nomor telepon pengguna harus dimasukkan',
            'alamat_rumah.required' => 'Alamat rumah pengguna harus dimasukkan',
            'jabatan.required' => 'Jabatan pengguna harus dimasukkan',
            'no_rekening.required' => 'Nomer rekening pengguna harus dimasukkan',
            'email.email' => 'Email pengguna harus dalam bentuk email',
        ]);

        // Ubah nilai kolom sesuai dengan data yang diterima dari $request
        $user->username = $request->username;
        $user->nik = $request->input('nik');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
        $user->alamat_rumah = $request->input('alamat_rumah');
        $user->jabatan = $request->input('jabatan');
        $user->no_rekening = $request->input('no_rekening');
        $user->updated_by = $request->input('username');

        $user->save();

        // Berikan respons sukses atau redirect sesuai kebutuhan Anda
        return redirect()->route('show_profile_admin', ['id' => $user->id])->with('success', 'Data pribadi pengguna berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function updateStatus(Request $request, $id_variabel_penilaian, $nama_dokumen)
{
    // Mengambil data dokumen
    $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)
                    ->where('nama_dokumen', $nama_dokumen)
                    ->first();
    
    $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)
                ->first();

    $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)
                ->first();
        

    // Memastikan dokumen ditemukan
    if (!$dokumen) {
        return view('admin.view_dokumen')->with('error', 'Dokumen tidak ditemukan');
    }

    // Memperbarui status
    if ($dokumen->status == 'approve') {
        // Jika sudah disetujui, tidak perlu dilakukan perubahan
        return redirect()->route('show_dokumen_admin', ['id_variabel_penilaian' => $id_variabel_penilaian])->with('success', 'Dokumen sudah disetujui dan tidak dapat diubah lagi');
    } else {
        // Jika status adalah not approve, ubah menjadi approve
        $dokumen->status = 'approve';
        $dokumen->save();

        $variabelPenilaian->status = 'approve';
        $variabelPenilaian->save();

        $realisasi->status = 'approve';
        $realisasi->save();

        return redirect()->route('show_dokumen_admin', ['id_variabel_penilaian' => $id_variabel_penilaian])->with('success', 'Status verifikasi berhasil diubah menjadi "Disetujui" dan tersimpan dalam database');
    }
}

    public function deleteAdmin($id_variabel_penilaian)
    {
        $variabelPenilaian = VariabelPenilaian::find($id_variabel_penilaian);
        $realisasi = Realisasi::find($id_variabel_penilaian);
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->where('flag_delete', '=', 0)->get();
        
        if ($variabelPenilaian || $realisasi || $dokumen->isEmpty()) {
            return view('admin.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('admin.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'));
    }

    public function konfirmDeleteAdmin(Request $request, $id_variabel_penilaian)
    {
        $loggedInUser = Auth::user();

        $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)->first();  // Use get() to retrieve the result
        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        $selectedNamaDokumen = $request->nama_dokumen;

        Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->where('nama_dokumen', $selectedNamaDokumen)->update(['flag_delete' => 1]);

        return redirect()->route('show_dokumen_admin', ['id_variabel_penilaian' => $variabelPenilaian->id_variabel_penilaian])->with('success', 'Dokumen berhasil dihapus dari database.');
    }

    public function detailFileAdmin()
    {
        $username = Auth::user()->username;

        $dokumen = Dokumen::where('flag_delete', '=', 0)->where('nama_dokumen', '!=', 'null')->where('inserted_by', $username)
                            ->paginate(5, ['*'], 'page', request()->page);

        if ($dokumen->isEmpty()) {
            return view('admin.detail_file_dokumen', compact('dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('admin.detail_file_dokumen', compact('dokumen'));
    }

    public function detailApproveAdmin()
    {
        $dokumen = Dokumen::where('flag_delete', '=', 0)
                            ->where('nama_dokumen', '!=', 'null')
                            ->where('status', '=', 'approve')
                            ->paginate(5, ['*'], 'page', request()->page);

        if ($dokumen->isEmpty()) {
            return view('admin.detail_file_approve', compact('dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('admin.detail_file_approve', compact('dokumen'));
    }

    public function detailNilaiAdmin(Request $request)
{
    $kode_penilaian = $request->get('kode');

    // Base query without search and chart interaction
    $nilai_dokumen = DB::table('realisasi')
        ->leftJoin('variabel_penilaian', function($join) {
            $join->on('realisasi.id', '=', 'variabel_penilaian.id')
                ->where('variabel_penilaian.flag_delete', '=', 0);
        })
        ->where('realisasi.flag_delete', '=', 0)
        ->where('realisasi.nilai', '!=', null)
        ->select('realisasi.*', 'variabel_penilaian.versi', 'variabel_penilaian.nilai_maksimal');  

    // Apply kode_penilaian filter if kode_penilaian parameter is provided
    if ($kode_penilaian) {
        $nilai_dokumen->where('variabel_penilaian.kode_penilaian', $kode_penilaian);
    }

    // Paginate the results
    $nilai_dokumen = $nilai_dokumen->orderBy('realisasi.tahun')->distinct()->paginate(5, ['*'], 'page', request()->page);

    // Return view with data
    return view('admin.detail_nilai_dokumen', compact('nilai_dokumen'));
}

    public function detailPengguna(Request $request)
    {
        $user = User::where('level', 'Karyawan')->paginate(5, ['*'], 'page', request()->page);
        $userA = User::where('level', 'Admin')->paginate(5, ['*'], 'page', request()->page);

        return view('admin.data_pengguna', compact('user', 'userA'));
    }

}
