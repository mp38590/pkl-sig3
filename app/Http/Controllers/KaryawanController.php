<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\VariabelPenilaian;
use App\Models\Realisasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function showDashboard()
    {
        $jumlah_dokumen = [];
        $username = Auth::user()->username;
        $user = User::where('username', $username)->first();
        $level = $user->level;

        $data = Realisasi::where('flag_delete', '=', 0)->get();

        $total_nilai = 0;
        $jumlah_data = count($data);
        
        foreach ($data as $realisasi) {
            if ($realisasi->nilai !== null) {
                $total_nilai += $realisasi->nilai;
            }
        }

        $rata_skor = $jumlah_data !== 0 ? $total_nilai / $jumlah_data : 0;
        $rata_skor = round($rata_skor, 4);

        $latestTimestamp = Realisasi::where('nilai', '!=', null)
                ->where('inserted_by', $username)
                ->max('updated_at');

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

        $data = Dokumen::select(DB::raw("EXTRACT(MONTH FROM created_at) as month"), DB::raw('COUNT(*) as total'))
                        ->where('nama_dokumen', '!=', null)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        $labels = $data->pluck('month');
        $values = $data->pluck('total');

        $rata = Realisasi::select(DB::raw("EXTRACT(MONTH FROM created_at) as month"), DB::raw("$rata_skor as average"))
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();
    
        $label = $rata->pluck('month');
        $average = $rata->pluck('average');

        $banyak_dokumen = Dokumen::where('nama_dokumen', '!=', null)
                                    ->where('inserted_by', $username)
                                    ->count();

        $banyak = Dokumen::select(DB::raw("EXTRACT(MONTH FROM created_at) as month"), DB::raw("id_variabel_penilaian as id_variabel_penilaian"), DB::raw("COUNT(nama_dokumen) as banyak"))
                                                ->groupBy('month', 'id_variabel_penilaian')
                                                ->orderBy('month')
                                                ->orderBy('id_variabel_penilaian')
                                                ->get();
                                            
        $x = $banyak->pluck('id_variabel_penilaian');
        $y = $banyak->pluck('banyak');
        $z = $banyak->pluck('month');

        $latestTimestampRealisasi = Realisasi::where('nilai', '!=', null)
                ->where('inserted_by', $username)
                ->max('updated_at');

        $nilai_dokumen = Realisasi::where('nilai', '!=', null)
                        ->where('inserted_by', $username)
                        ->get();

        $nilai = Realisasi::select(DB::raw("kode_penilaian as kode_penilaian"), DB::raw("SUM(nilai) as total_nilai"))
                            ->where('nilai', '!=', null)
                            ->where('inserted_by', $username)
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

        return view('karyawan.dashboard_karyawan', compact('user', 'jumlah_dokumen', 'rata_skor', 'presentase', 'latestTimestamp', 'labels', 'values', 'label', 'average', 'x', 'y', 'z', 'banyak', 'l', 'm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
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
    
        // Check if data is empty
        if ($detail_dokumen->isEmpty()) {
            return view('karyawan.detail_dokumen', compact('detail_dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
    
        return view('karyawan.detail_dokumen', compact('detail_dokumen'));
    }
    

    public function tambah()
    {
        return view('karyawan.tambah_dokumen');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'versi' => 'required|min:1|max:5',
        ], [
            'tahun.required' => 'Tahun upload dokumen harus dimasukkan',
            'versi.required' => 'Versi dokumen harus dimasukkan',
        ]);

        $loggedInUser = Auth::user();

        // Ambil semua data dari VariabelPenilaian
        $dataVariabel = VariabelPenilaian::all();

        // Cek apakah tahun sudah ada dalam tabel Realisasi
        $tahunExists = Realisasi::where('tahun', $request->tahun)->exists();

        if ($tahunExists) {
            return redirect()->route('detail_dokumen')->with('error', 'Tahun sudah ada dalam database');
        }

        $versiUploaded = true;
        foreach ($dataVariabel as $variabel) {
            $realisasiExists = Realisasi::where('item_penilaian', $variabel->item_penilaian)->exists();
            $dokumenExists = Dokumen::where('item_penilaian', $variabel->item_penilaian)->exists();

            if (!$realisasiExists || !$dokumenExists) {
                $versiUploaded = false;
                break;
            }
        }

        // Jika versi sudah terupload untuk semua item penilaian, tampilkan pesan error
        if ($versiUploaded) {
            return redirect()->route('detail_dokumen')->with('error', 'Versi untuk semua item penilaian sudah terupload');
        }

        // Iterasi melalui setiap baris VariabelPenilaian
        foreach ($dataVariabel as $variabel) {
            // Cek apakah data sudah ada di tabel Realisasi dan Dokumen
            $realisasiExists = Realisasi::where('item_penilaian', $variabel->item_penilaian)->exists();
            $dokumenExists = Dokumen::where('item_penilaian', $variabel->item_penilaian)->exists();

            // Jika data belum ada, tambahkan ke tabel Realisasi dan Dokumen
            if (!$realisasiExists) {
                $tahun = $request->tahun;
                
                $realisasi = new Realisasi();
                $realisasi->id_variabel_penilaian = $variabel->id_variabel_penilaian;
                $realisasi->tahun = $request->tahun;
                $realisasi->item_penilaian = $variabel->item_penilaian;
                $realisasi->kode_penilaian = $variabel->kode_penilaian;
                $realisasi->deskripsi_item_penilaian = $variabel->deskripsi_item_penilaian;
                $realisasi->status = 'not approve';
                $realisasi->flag_delete = $variabel->flag_delete;
                $realisasi->inserted_by = $loggedInUser->username;
                $realisasi->updated_by = $loggedInUser->username;
                $realisasi->save();
            }

            if (!$dokumenExists) {
                $dokumen = new Dokumen();
                $dokumen->id_variabel_penilaian = $variabel->id_variabel_penilaian;
                $dokumen->item_penilaian = $variabel->item_penilaian;
                $dokumen->kode_penilaian = $variabel->kode_penilaian;
                $dokumen->deskripsi_item_penilaian = $variabel->deskripsi_item_penilaian;
                $dokumen->status = 'not approve';
                $dokumen->flag_delete = $variabel->flag_delete;
                $dokumen->inserted_by = $loggedInUser->username;
                $dokumen->updated_by = $loggedInUser->username;
                $dokumen->save();
            }
            $variabel->update(['inserted_by' => $loggedInUser->username]);
            $variabel->update(['updated_by' => $loggedInUser->username]);
            $variabel->save();
        }

        return redirect()->route('detail_dokumen')->with('success', 'Data berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function tambahFile($id_variabel_penilaian)
    {
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        return view('karyawan.upload_dokumen', compact('dokumen', 'variabelPenilaian', 'realisasi'));
    }
    
    public function uploadFile(Request $request, $id_variabel_penilaian)
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
        return redirect()->route('detail_dokumen')->with('success', 'File dokumen berhasil dimasukkan dan ditambahkan dalam database')->with('dokumen', $dokumen);
    }

    public function showDokumen($id_variabel_penilaian)
    {
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->where('flag_delete', '=', 0)->where('nama_dokumen', '!=', null)->get();
        $variabelPenilaian = VariabelPenilaian::find($id_variabel_penilaian);
        $realisasi = Realisasi::find($id_variabel_penilaian);

        if ($dokumen->isEmpty()) {
            return view('karyawan.view_dokumen', compact('dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('karyawan.view_dokumen', compact('dokumen', 'variabelPenilaian', 'realisasi'));
    }

    public function lihatFile($id_variabel_penilaian, $nama_dokumen)
    {
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->where('nama_dokumen', $nama_dokumen)->first();

        if (!$dokumen) {
            abort(404); // Handle jika dokumen tidak ditemukan
        }

        $filePath = public_path('uploads/file/' . $dokumen->nama_dokumen);

        return response()->file($filePath);
    }

    public function edit($id_variabel_penilaian)
    {
        $variabelPenilaian = VariabelPenilaian::find($id_variabel_penilaian);
        $realisasi = Realisasi::find($id_variabel_penilaian);

        if ($variabelPenilaian || $realisasi->isEmpty()) {
            return view('karyawan.edit_skor', compact('variabelPenilaian', 'realisasi'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }

        return view('karyawan.edit_skor', compact('variabelPenilaian', 'realisasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     */
    public function update(Request $request, $id_variabel_penilaian)
    {
        $loggedInUser = Auth::user();

        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian);

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
        return redirect()->route('detail_dokumen')->with('success', 'Skor maksimal dan final berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function delete($id_variabel_penilaian)
    {
        $variabelPenilaian = VariabelPenilaian::find($id_variabel_penilaian);
        $realisasi = Realisasi::find($id_variabel_penilaian);
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->where('flag_delete', '=', 0)->get();
        
        if ($variabelPenilaian || $realisasi || $dokumen->isEmpty()) {
            return view('karyawan.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('karyawan.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'));
    }

    public function konfirmDelete(Request $request, $id_variabel_penilaian)
    {
        $loggedInUser = Auth::user();

        $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)->first();  // Use get() to retrieve the result
        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        $dokumen = Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        $selectedNamaDokumen = $request->nama_dokumen;

        Dokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->where('nama_dokumen', $selectedNamaDokumen)->update(['flag_delete' => 1]);

        return redirect()->route('detail_dokumen')->with('success', 'Data deleted successfully.');
    }

    public function showProfile($id){
        $user = User::find($id);

        return view('karyawan.profile', compact('user'));
    }

    public function editProfile($id){
        $user = User::find($id);

        return view('karyawan.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
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
        return redirect()->route('show_profile', ['id' => $user->id])->with('success', 'Data pribadi pengguna berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function editDataProfile($id){
        $user = User::find($id);

        return view('karyawan.edit_data_profile', compact('user'));
    }

    public function updateDataProfile(Request $request, $id)
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
        return redirect()->route('show_profile', ['id' => $user->id])->with('success', 'Data pribadi pengguna berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function pilihDokumen()
    {
        $dokumen = Dokumen::orderBy('nama_dokumen')->get();

        if ($dokumen) {
            return view('karyawan.hapus_dokumen', compact('dokumen'));
        } else {
            // Handle the case where the query did not return data
            dd("No data retrieved from the database");
        }
    }

    public function detailVariabel(Request $request)
    {   
        $search = $request->get('search');
        $detail_variabel = VariabelPenilaian::where('flag_delete', '=', 0);

        if ($search) {
            $detail_variabel = $detail_variabel->where('versi', 'like', '%'.$search.'%')
                                            ->orWhere('kode_penilaian', 'like', '%'.$search.'%')
                                            ->orWhere('item_penilaian', 'like', '%'.$search.'%')
                                            ->orWhere('deskripsi_item_penilaian', 'like', '%'.$search.'%')
                                            ->orWhere('nilai_maksimal', 'like', '%'.$search.'%');
        }

        $detail_variabel = $detail_variabel->paginate(5, ['*'], 'page', request()->page);

        // Check if data is empty
        if ($detail_variabel->isEmpty()) {
            return view('karyawan.detail_variabel_penilaian', compact('detail_variabel'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }

        return view('karyawan.detail_variabel_penilaian', compact('detail_variabel'));
    }

    public function tambahVariabel()
    {
        return view('karyawan.tambah_variabel');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpanVariabel(Request $request)
    {
        $request->validate([
            'versi' => 'required|min:1|max:5',
            'kode_penilaian' => 'required|min:1|max:255',
            'item_penilaian' => 'required|min:1|max:255',
            'deskripsi_item_penilaian' => 'required|min:1|max:255',
            'nilai_maksimal' => 'required|min:1|max:5',
        ], [
            'versi.required' => 'Versi dokumen harus dimasukkan',
            'kode_penilaian.required' => 'Kode penilaian dokumen harus dimasukkan',
            'item_penilaian.required' => 'Item penilaian dokumen harus dimasukkan',
            'deskripsi_item_penilaian.required' => 'Deskripsi item penilaian dokumen harus dimasukkan',
            'nilai_maksimal.required' => 'Nilai maksimal dokumen harus dimasukkan',
        ]);

        $loggedInUser = Auth::user();

        $variabelPenilaian = new VariabelPenilaian();
        $variabelPenilaian->versi = $request->versi;
        $variabelPenilaian->item_penilaian = $request->item_penilaian;
        $variabelPenilaian->kode_penilaian = $request->kode_penilaian;
        $variabelPenilaian->deskripsi_item_penilaian = $request->deskripsi_item_penilaian;
        $variabelPenilaian->nilai_maksimal = $request->nilai_maksimal;
        $variabelPenilaian->status = 'not approve';
        $variabelPenilaian->flag_delete = 0;
        $variabelPenilaian->inserted_by = $loggedInUser->username;
        $variabelPenilaian->updated_by = $loggedInUser->username;
        $variabelPenilaian->save();

        $variabelPenilaian->id_variabel_penilaian = $variabelPenilaian->id;
        $variabelPenilaian->save();

        return redirect()->route('detail_variabel')->with('success', 'Data berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function editVariabel($id_variabel_penilaian)
    {
        $variabelPenilaian = VariabelPenilaian::find($id_variabel_penilaian);

        if (!$variabelPenilaian) {
            return view('karyawan.edit_variabel')->with('error', 'Tidak Ada Data yang ditampilkan');
        }

        return view('karyawan.edit_variabel', compact('variabelPenilaian'));
    }

    public function updateVariabel(Request $request, $id_variabel_penilaian)
    {
        // Validasi request
        $request->validate([
            'versi' => 'required|min:1|max:5',
            'kode_penilaian' => 'required|min:1|max:255',
            'item_penilaian' => 'required|min:1|max:255',
            'deskripsi_item_penilaian' => 'required|min:1|max:255',
            'nilai_maksimal' => 'required|min:1|max:5',
        ], [
            'versi.required' => 'Versi dokumen harus dimasukkan',
            'kode_penilaian.required' => 'Kode penilaian dokumen harus dimasukkan',
            'item_penilaian.required' => 'Item penilaian dokumen harus dimasukkan',
            'deskripsi_item_penilaian.required' => 'Deskripsi item penilaian dokumen harus dimasukkan',
            'nilai_maksimal.required' => 'Nilai maksimal dokumen harus dimasukkan',
        ]);

        $loggedInUser = Auth::user();

        // Mengambil data variabel penilaian yang akan diupdate
        $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)->first();
        if ($variabelPenilaian) {
            $variabelPenilaian->update([
                'flag_delete' => 2,
            ]);

            $newVariabelPenilaian = new VariabelPenilaian;
            $newVariabelPenilaian->id_variabel_penilaian = $variabelPenilaian->id_variabel_penilaian;
            $newVariabelPenilaian->versi = $request->versi;
            $newVariabelPenilaian->kode_penilaian = $request->kode_penilaian;
            $newVariabelPenilaian->item_penilaian = $request->item_penilaian;
            $newVariabelPenilaian->deskripsi_item_penilaian = $request->deskripsi_item_penilaian;
            $newVariabelPenilaian->nilai_maksimal = $request->nilai_maksimal;
            $newVariabelPenilaian->status = 'not approve';
            $newVariabelPenilaian->inserted_by = $loggedInUser->username;
            $newVariabelPenilaian->updated_by = $loggedInUser->username;
            $newVariabelPenilaian->flag_delete = 0;
            $newVariabelPenilaian->save();
        } 

        // Mengambil data realisasi yang akan diupdate
        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)->first();

        // Jika realisasi ditemukan, maka update juga realisasi
        if ($realisasi) {
            $realisasi->update([
                'flag_delete' => 2,
            ]);

            $newRealisasi = new Realisasi;
            $newRealisasi->id_variabel_penilaian = $variabelPenilaian->id_variabel_penilaian;
            $newRealisasi->kode_penilaian = $request->kode_penilaian;
            $newRealisasi->item_penilaian = $request->item_penilaian;
            $newRealisasi->deskripsi_item_penilaian = $request->deskripsi_item_penilaian;
            $newRealisasi->status = 'not approve';
            $newRealisasi->inserted_by = $loggedInUser->username;
            $newRealisasi->updated_by = $loggedInUser->username;
            $newRealisasi->flag_delete = 0;

            $newRealisasi->tahun = $realisasi->tahun;
            $newRealisasi->save();
        }

        $dokumen = pilihDokumen::where('id_variabel_penilaian', $id_variabel_penilaian)->first();

        // Jika realisasi ditemukan, maka update juga realisasi
        if ($dokumen) {
            $dokumen->update([
                'flag_delete' => 2,
            ]);

            $newDokumen = new Dokumen;
            $newDokumen->id_variabel_penilaian = $variabelPenilaian->id_variabel_penilaian;
            $newDokumen->kode_penilaian = $request->kode_penilaian;
            $newDokumen->item_penilaian = $request->item_penilaian;
            $newDokumen->deskripsi_item_penilaian = $request->deskripsi_item_penilaian;
            $newDokumen->status = 'not approve';
            $newDokumen->inserted_by = $loggedInUser->username;
            $newDokumen->updated_by = $loggedInUser->username;
            $newDokumen->flag_delete = 0;

            $newDokumen->tahun = $realisasi->tahun;
            $newDokumen->save();
        }

    // Berikan respons sukses atau redirect sesuai kebutuhan Anda
    return redirect()->route('detail_variabel')->with('success', 'Data variabel penilaian dokumen berhasil dimasukkan dan ditambahkan dalam database');
}

    public function deleteVariabel($id_variabel_penilaian)
    {
        $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)->where('flag_delete', '=', 0)->first();

        if (!$variabelPenilaian) {
            return view('karyawan.hapus_variabel')->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('karyawan.hapus_variabel', compact('variabelPenilaian'));
    }

    public function konfirmDeleteVariabel($id_variabel_penilaian)
    {
        $loggedInUser = Auth::user();

        $variabelPenilaian = VariabelPenilaian::where('id_variabel_penilaian', $id_variabel_penilaian)->where('flag_delete', '=', 0)->first();
        $realisasi = Realisasi::where('id_variabel_penilaian', $id_variabel_penilaian)->where('flag_delete', '=', 0)->first();  // Use get() to retrieve the result

        $variabelPenilaian->flag_delete = 1;
        $variabelPenilaian->save();

        if(!$realisasi){
            
        }
        else{
            $realisasi->flag_delete = 1;
            $realisasi->save();
        }

        return redirect()->route('detail_variabel')->with('success', 'Data deleted successfully.');
    }

    public function detailFile()
    {
        $dokumen = Dokumen::where('flag_delete', '=', 0)->where('nama_dokumen', '!=', 'null')->paginate(5);

        if ($dokumen->isEmpty()) {
            return view('karyawan.detail_file_dokumen', compact('dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('karyawan.detail_file_dokumen', compact('dokumen'));
    }

    public function detailNilai(Request $request)
{
    $search = $request->get('search');
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

    // Apply search filter if search parameter is provided
    if ($search) {
        $nilai_dokumen->where(function($query) use ($search) {
            // Check if the search term is an integer
            if (ctype_digit($search)) {
                // If the search term is an integer, search only in the 'nilai' column of 'realisasi'
                $query->where('realisasi.nilai', 'like', '%' . $search . '%');
            } else {
                // If the search term is not an integer, search in all relevant columns
                $query->where('realisasi.tahun', 'like', '%' . $search . '%')
                    ->orWhere('realisasi.kode_penilaian', 'like', '%' . $search . '%')
                    ->orWhere('realisasi.item_penilaian', 'like', '%' . $search . '%')
                    ->orWhere('realisasi.deskripsi_item_penilaian', 'like', '%' . $search . '%');
            }
        });
    }    

    // Apply kode_penilaian filter if kode_penilaian parameter is provided
    if ($kode_penilaian) {
        $nilai_dokumen->where('variabel_penilaian.kode_penilaian', $kode_penilaian);
    }

    // Paginate the results
    $nilai_dokumen = $nilai_dokumen->orderBy('realisasi.tahun')->distinct()->paginate(5);

    // Return view with data
    return view('karyawan.detail_nilai_dokumen', compact('nilai_dokumen'));
}

}
