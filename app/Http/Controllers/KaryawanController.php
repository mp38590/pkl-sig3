<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\VariabelPenilaian;
use App\Models\Realisasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
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
            $realisasi->inserted_by = $loggedInUser->username;
            $realisasi->updated_by = $loggedInUser->username;
            $realisasi->save();
        }

        if (!$dokumenExists) {
            $dokumen = new Dokumen();
            $dokumen->item_penilaian = $variabel->item_penilaian;
            $dokumen->kode_penilaian = $variabel->kode_penilaian;
            $dokumen->deskripsi_item_penilaian = $variabel->deskripsi_item_penilaian;
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
        'file' => 'required|mimes:pdf',
    ], [
        'file.required' => 'Nama Dokumen harus dimasukkan',
        'file.mimes' => 'Dokumen harus dalam format pdf',
    ]);

    if ($request->hasFile('file')) {
        // Simpan file PDF IRS ke direktori storage/app/public/scan_irs
        $pdfFileName = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('app/public/', $pdfFileName);
        $dokumen->nama_dokumen = $pdfFileName;
    }

    $dokumen->save();

    // Pass $dokumen to the view
    return redirect()->route('detail_dokumen')->with('success', 'File dokumen berhasil dimasukkan dan ditambahkan dalam database')->with('dokumen', $dokumen);
}

    public function showDokumen($id)
    {
        $dokumen = Dokumen::find($id);
        $variabelPenilaian = VariabelPenilaian::find($id);
        $realisasi = Realisasi::find($id);

        return view('karyawan.view_dokumen', compact('dokumen', 'variabelPenilaian', 'realisasi'));
    }

    public function lihatFile($id)
    {
        $dokumen = Dokumen::find($id);

        if (!$dokumen) {
            abort(404); // Handle jika dokumen tidak ditemukan
        }

        $pdfFileName = 'app/public/' . $dokumen->nama_dokumen;

        return response()->file(storage_path($pdfFileName));
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

        $variabelPenilaian = VariabelPenilaian::where('id', $id);
        $realisasi = Realisasi::where('id', $id);

        $request->validate([
            'nilai_maksimal' => 'required|min:1|max:5',
            'nilai' => 'required|min:1|max:5',
        ], [
            'nilai_maksimal.required' => 'Nilai maksimal harus dimasukkan',
            'nilai.required' => 'Nilai final harus dimasukkan',
        ]);

        // Ubah nilai kolom sesuai dengan data yang diterima dari $request
        $variabelPenilaian->update(['nilai_maksimal' => $request->input('nilai_maksimal')]);
        $realisasi->update(['nilai' => $request->input('nilai')]);

        // Set informasi pengguna yang menyimpan data
        $variabelPenilaian->update(['updated_by' => $loggedInUser->username]);
        $realisasi->update(['updated_by' => $loggedInUser->username]);

        // Berikan respons sukses atau redirect sesuai kebutuhan Anda
        return redirect()->route('detail_dokumen')->with('success', 'Skor maksimal dan final berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function delete($id)
    {
        $variabelPenilaian = VariabelPenilaian::find($id);
        $realisasi = Realisasi::find($id);
        $dokumen = Dokumen::find($id);

        if ($variabelPenilaian || $realisasi || $dokumen->isEmpty()) {
            return view('karyawan.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('karyawan.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'));
    }

    public function konfirmDelete($id)
    {
        $loggedInUser = Auth::user();

        $variabelPenilaian = VariabelPenilaian::where('id', $id)->first();  // Use get() to retrieve the result
        $realisasi = Realisasi::where('id', $id)->first();
        $dokumen = Dokumen::where('id', $id)->first();

        $variabelPenilaian->delete();
        $realisasi->delete();
        $dokumen->delete();

        return redirect()->route('detail_dokumen')->with('success', 'Data deleted successfully.');
    }

    public function showProfile($id){
        $user = User::find($id);

        return view('karyawan.profile', compact('user'));
    }

    public function editProfile($id){
        $user = User::find($id);

        return view('karyawan.edit_profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
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
        $user->username = $request->input('username');
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
}
