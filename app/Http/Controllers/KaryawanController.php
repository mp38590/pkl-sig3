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

        $data = Realisasi::where('inserted_by', $username)->get();

        $total_nilai = 0;
        $jumlah_data = count($data);
        
        foreach ($data as $realisasi) {
            if ($realisasi->nilai !== null) {
                $total_nilai += $realisasi->nilai;
            }
        }
        
        $rata_skor = $total_nilai / $jumlah_data;                  
        $rata_skor = round($rata_skor, 4);

        $latestTimestamp = Realisasi::where('nilai', '!=', null)
                ->where('inserted_by', $username)
                ->max('updated_at');

        $jumlah_dokumen = Dokumen::where('nama_dokumen', '!=', null)->where('inserted_by', $username)
                                    ->count();
        $existingDokumen = Dokumen::first();
        $created_at = $existingDokumen->created_at;
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

        if($level =='Admin'){
            return view('admin.dashboard_admin', compact('user', 'jumlah_dokumen', 'rata_skor', 'presentase', 'latestTimestamp', 'labels', 'values', 'label', 'average'));
        }
        else{
            return view('karyawan.dashboard_karyawan', compact('user', 'jumlah_dokumen', 'rata_skor', 'presentase', 'latestTimestamp', 'labels', 'values', 'label', 'average'));
        }
    }

    public function sync()
    {
        return response()->json(['status' => 'success']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
{
    $tahun = $request->get('tahun');
    
    $query = DB::table('variabel_penilaian')
        ->join('realisasi', 'variabel_penilaian.item_penilaian', '=', 'realisasi.item_penilaian')
        ->groupBy('realisasi.id', 'variabel_penilaian.id')
        ->where('variabel_penilaian.flag_delete', '=', 0)
        ->distinct();

    // Check if the "tahun" parameter is provided
    if ($tahun) {
        $query->where('realisasi.tahun', '=', $tahun);
    }

    $detail_dokumen = $query->orderBy('realisasi.tahun', 'asc')->get();

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
                $realisasi = new Realisasi();
                $realisasi->tahun = $request->tahun;
                $realisasi->item_penilaian = $variabel->item_penilaian;
                $realisasi->kode_penilaian = $variabel->kode_penilaian;
                $realisasi->deskripsi_item_penilaian = $variabel->deskripsi_item_penilaian;
                $realisasi->flag_delete = $variabel->flag_delete;
                $realisasi->inserted_by = $loggedInUser->username;
                $realisasi->updated_by = $loggedInUser->username;
                $realisasi->save();
            }

            if (!$dokumenExists) {
                $dokumen = new Dokumen();
                $dokumen->item_penilaian = $variabel->item_penilaian;
                $dokumen->kode_penilaian = $variabel->kode_penilaian;
                $dokumen->deskripsi_item_penilaian = $variabel->deskripsi_item_penilaian;
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

    public function file($id)
    {
        $dokumen = Dokumen::find($id);
        $variabelPenilaian = VariabelPenilaian::find($id);
        $realisasi = Realisasi::find($id);
        return view('karyawan.upload_dokumen', compact('dokumen', 'variabelPenilaian', 'realisasi'));
    }
    
    public function upload(Request $request, $id)
    {
        $loggedInUser = Auth::user();

        $dokumen = Dokumen::where('id', $id)->first();
        
        // $existingData = VariabelPenilaian::first();  // Change YourModel to the actual model you are using
        // $item_penilaian = $existingData->item_penilaian;

        // $dokumen = Dokumen::where('item_penilaian', $item_penilaian)->first();

        $request->validate([
            'file.*' => 'required|mimes:pdf',
        ], [
            'file.*.required' => 'Nama Dokumen harus dimasukkan',
            'file.*.mimes' => 'Dokumen harus dalam format pdf',
        ]);

        $dataRealisasi = Realisasi::all();

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $pdf) {
                $pdfName = $pdf->getClientOriginalName();
                $pdf->move(public_path('uploads/file'), $pdfName);
        
                // Check if the Dokumen with the given ID already has a document
                $existingDokumen = Dokumen::find($request->id);
        
                if (!$existingDokumen->nama_dokumen) {
                    // If the Dokumen does not have a document, update the existing record
                    $existingDokumen->nama_dokumen = $pdfName;
                    $existingDokumen->save();
                } else {
                    // If the Dokumen already has a document, create a new record
                    $newDokumen = new Dokumen;
                    $newDokumen->id = $request->id;
                    $newDokumen->kode_penilaian = $existingDokumen->kode_penilaian;
                    $newDokumen->item_penilaian = $existingDokumen->item_penilaian;
                    $newDokumen->deskripsi_item_penilaian = $existingDokumen->deskripsi_item_penilaian;
                    $newDokumen->inserted_by = $existingDokumen->inserted_by;
                    $newDokumen->updated_by = $existingDokumen->updated_by;
                    $newDokumen->flag_delete = 0;
                    $newDokumen->nama_dokumen = $pdfName;
        
                    $newDokumen->save();
                }
            }
        }        

        // Pass $dokumen to the view
        return redirect()->route('detail_dokumen')->with('success', 'File dokumen berhasil dimasukkan dan ditambahkan dalam database')->with('dokumen', $dokumen);
    }

    public function showDokumen($id)
    {
        $dokumen = Dokumen::where('id', $id)->where('flag_delete', '=', 0)->get();
        $variabelPenilaian = VariabelPenilaian::find($id);
        $realisasi = Realisasi::find($id);

        return view('karyawan.view_dokumen', compact('dokumen', 'variabelPenilaian', 'realisasi'));
    }

    public function lihatFile($id, $nama_dokumen)
    {
        $dokumen = Dokumen::where('id', $id)->where('nama_dokumen', $nama_dokumen)->first();

        if (!$dokumen) {
            abort(404); // Handle jika dokumen tidak ditemukan
        }

        $filePath = public_path('uploads/file/' . $dokumen->nama_dokumen);

        return response()->file($filePath);
    }

    public function edit($id)
    {
        $variabelPenilaian = VariabelPenilaian::find($id);
        $realisasi = Realisasi::find($id);

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
    public function update(Request $request, $id)
    {
        $loggedInUser = Auth::user();

        $realisasi = Realisasi::where('id', $id);

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

    public function delete($id)
    {
        $variabelPenilaian = VariabelPenilaian::find($id);
        $realisasi = Realisasi::find($id);
        $dokumen = Dokumen::where('id', $id)->where('flag_delete', '=', 0)->get();
        
        if ($variabelPenilaian || $realisasi || $dokumen->isEmpty()) {
            return view('karyawan.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('karyawan.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'));
    }

    public function konfirmDelete(Request $request, $id)
    {
        $loggedInUser = Auth::user();

        $variabelPenilaian = VariabelPenilaian::where('id', $id)->first();  // Use get() to retrieve the result
        $realisasi = Realisasi::where('id', $id)->first();
        $dokumen = Dokumen::where('id', $id)->first();
        $selectedNamaDokumen = $request->nama_dokumen;

        Dokumen::where('id', $id)->where('nama_dokumen', $selectedNamaDokumen)->update(['flag_delete' => 1]);

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
    $versi = $request->get('versi');
    
    $query = VariabelPenilaian::groupBy('variabel_penilaian.id')
                                ->where('variabel_penilaian.flag_delete', '=', 0);

    // Check if the "tahun" parameter is provided
    if ($versi) {
        $query->where('variabel_penilaian.versi', '=', $versi);
    }

    $detail_variabel = $query->orderBy('variabel_penilaian.versi', 'asc')->get();

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
        $variabelPenilaian->flag_delete = 0;
        $variabelPenilaian->inserted_by = $loggedInUser->username;
        $variabelPenilaian->updated_by = $loggedInUser->username;
        $variabelPenilaian->save();

        return redirect()->route('detail_variabel')->with('success', 'Data berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function editVariabel($id)
    {
        $variabelPenilaian = VariabelPenilaian::find($id);

        if (!$variabelPenilaian) {
            return view('karyawan.edit_variabel')->with('error', 'Tidak Ada Data yang ditampilkan');
        }

        return view('karyawan.edit_variabel', compact('variabelPenilaian'));
    }

    public function updateVariabel(Request $request, $id)
    {
        $loggedInUser = Auth::user();

        $variabelPenilaian = VariabelPenilaian::where('id', $id);

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

        // Ubah nilai kolom sesuai dengan data yang diterima dari $request
        $variabelPenilaian->update(['versi' => $request->input('versi')]);
        $variabelPenilaian->update(['kode_penilaian' => $request->input('kode_penilaian')]);
        $variabelPenilaian->update(['item_penilaian' => $request->input('item_penilaian')]);
        $variabelPenilaian->update(['deskripsi_item_penilaian' => $request->input('deskripsi_item_penilaian')]);
        $variabelPenilaian->update(['nilai_maksimal' => $request->input('nilai_maksimal')]);
        $variabelPenilaian->update(['updated_by' => $loggedInUser->username]);

        // Berikan respons sukses atau redirect sesuai kebutuhan Anda
        return redirect()->route('detail_variabel')->with('success', 'Data variabel penilaian dokumen berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function deleteVariabel($id)
    {
        $variabelPenilaian = VariabelPenilaian::find($id);

        if (!$variabelPenilaian) {
            return view('karyawan.hapus_variabel')->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('karyawan.hapus_variabel', compact('variabelPenilaian'));
    }

    public function konfirmDeleteVariabel($id)
    {
        $loggedInUser = Auth::user();

        $variabelPenilaian = VariabelPenilaian::where('id', $id)->first();  // Use get() to retrieve the result

        $variabelPenilaian->flag_delete = 1;
        $variabelPenilaian->save();

        return redirect()->route('detail_variabel')->with('success', 'Data deleted successfully.');
    }
}
