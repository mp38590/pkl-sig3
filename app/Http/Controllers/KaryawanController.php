<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\VariabelPenilaian;
use App\Models\Realisasi;
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
    public function detail()
    {
        $detail_dokumen = DB::table('variabel_penilaian')
                        ->select('variabel_penilaian.*', DB::raw('MAX(realisasi.tahun) as tahun'), DB::raw('MAX(realisasi.nilai) as nilai'), DB::raw('MAX(dokumen.nama_dokumen) as nama_dokumen'))
                        ->join('realisasi', 'variabel_penilaian.kode_penilaian', '=', 'realisasi.kode_penilaian')
                        ->join('dokumen', 'variabel_penilaian.kode_penilaian', '=', 'dokumen.kode_penilaian')
                        ->groupBy('variabel_penilaian.item_penilaian', 'variabel_penilaian.id')
                        ->orderBy('created_at', 'asc')
                        ->get();


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
            'kode_penilaian' => 'required|min:5|max:255',
            'item_penilaian' => 'required|min:5|max:255',
            'deskripsi_item_penilaian' => 'required|min:5|max:2000',
        ], [
            'tahun.required' => 'Tahun upload dokumen harus dimasukkan',
            'versi.required' => 'Versi dokumen harus dimasukkan',
            'kode_penilaian.required' => 'Kode penilaian untuk dokumen harus dimasukkan',
            'item_penilaian.required' => 'Item penilaian untuk dokumen harus dimasukkan',
            'deskripsi_item_penilaian.required' => 'Deskripsi dari item penilaian dokumen harus dimasukkan',
        ]);

        $loggedInUser = Auth::user();
        
        // Save data to 'variabel_penilaian' table
        $variabelPenilaian = new VariabelPenilaian();
        $variabelPenilaian->versi = $request->versi;
        $variabelPenilaian->kode_penilaian = $request->kode_penilaian;
        $variabelPenilaian->item_penilaian = $request->item_penilaian;
        $variabelPenilaian->deskripsi_item_penilaian = $request->deskripsi_item_penilaian;
        $variabelPenilaian->inserted_by = $loggedInUser->username;
        $variabelPenilaian->updated_by = $loggedInUser->username;
        $variabelPenilaian->save();

        // Save data to 'realisasi' table
        $realisasi = new Realisasi();
        $realisasi->tahun = $request->tahun;
        $realisasi->kode_penilaian = $request->kode_penilaian;
        $realisasi->item_penilaian = $request->item_penilaian;
        $realisasi->deskripsi_item_penilaian = $request->deskripsi_item_penilaian;
        $realisasi->inserted_by = $loggedInUser->username;
        $realisasi->updated_by = $loggedInUser->username;
        $realisasi->save();

        // Save data to 'realisasi' table
        $dokumen = new Dokumen();
        $dokumen->kode_penilaian = $request->kode_penilaian;
        $dokumen->item_penilaian = $request->item_penilaian;
        $dokumen->deskripsi_item_penilaian = $request->deskripsi_item_penilaian;
        $dokumen->inserted_by = $loggedInUser->username;
        $dokumen->updated_by = $loggedInUser->username;
        $dokumen->save();

        return redirect()->route('detail_dokumen')->with('success', 'Data berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function file($id)
    {
        $dokumen = Dokumen::find($id);
        return view('karyawan.upload_dokumen', compact('dokumen'));
    }
    
    public function upload(Request $request)
{
    $loggedInUser = Auth::user();

    $existingData = Dokumen::first();
    $id = $existingData->id;
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
    public function update(Request $request)
    {
        $loggedInUser = Auth::user();

        $existingData = VariabelPenilaian::first();  // Change YourModel to the actual model you are using
        $item_penilaian = $existingData->item_penilaian;
        $variabelPenilaian = VariabelPenilaian::where('item_penilaian', $item_penilaian);

        $request->validate([
            'nilai_maksimal' => 'required|min:1|max:5',
            'nilai' => 'required|min:1|max:5',
        ], [
            'nilai_maksimal.required' => 'Nilai maksimal harus dimasukkan',
            'nilai.required' => 'Nilai final harus dimasukkan',
        ]);

        // Ubah nilai kolom sesuai dengan data yang diterima dari $request
        $variabelPenilaian->update(['nilai_maksimal' => $request->input('nilai_maksimal')]);
        $variabelPenilaian->update(['updated_by' => $loggedInUser->username]);

        $existingDataReal = Realisasi::first();  // Change YourModel to the actual model you are using
        $item_penilaian = $existingDataReal->item_penilaian;
        $realisasi = Realisasi::where('item_penilaian', $item_penilaian);
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
        $dokumen = Dokumen::find($id);

        if ($variabelPenilaian || $realisasi || $dokumen->isEmpty()) {
            return view('karyawan.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        return view('karyawan.hapus_dokumen', compact('variabelPenilaian', 'realisasi', 'dokumen'));
    }

    public function konfirmDelete()
    {
        $loggedInUser = Auth::user();

        // $variabelPenilaian = VariabelPenilaian::find($id);
        // $realisasi = Realisasi::find($id);
        // $dokumen = Dokumen::find($id);

        $loggedInUser = Auth::user();

        $existingData = VariabelPenilaian::first();  // Change YourModel to the actual model you are using

        $item_penilaian = $existingData->item_penilaian;  // Corrected line

        $variabelPenilaian = VariabelPenilaian::where('item_penilaian', $item_penilaian)->get();  // Use get() to retrieve the result

        $realisasi = Realisasi::where('item_penilaian', $item_penilaian)->get();

        $dokumen = Dokumen::where('item_penilaian', $item_penilaian)->get();

        $loggedInUser = Auth::user();

        // Delete each instance in the collection
        foreach ($variabelPenilaian as $item) {
            $item->delete();
        }

        foreach ($realisasi as $item) {
            $item->delete();
        }

        foreach ($dokumen as $item) {
            $item->delete();
        }



        // // Hapus file terkait jika perlu (gantilah 'nama_dokumen' sesuai dengan kolom yang menyimpan nama file)
        // if ($dokumen) {
        //     // // Get the file path
        //     // $filePath = 'app/public/' . $dokumen->nama_dokumen;
        
        //     // // Check if the file exists
        //     // if (file_exists(storage_path($filePath))) {
        //     //     // Delete the file
        //     //     unlink(storage_path($filePath));
        //     // }
        
        //     // Delete the model from the database
        //     $dokumen->delete();
        // }

        return redirect()->route('detail_dokumen')->with('success', 'Data deleted successfully.');
    }
}
