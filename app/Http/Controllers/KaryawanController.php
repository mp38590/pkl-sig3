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
                        ->join('realisasi', 'variabel_penilaian.kode_penilaian', '=', 'realisasi.kode_penilaian')
                        ->join('dokumen', 'variabel_penilaian.kode_penilaian', '=', 'dokumen.kode_penilaian')
                        ->select('variabel_penilaian.*', 'realisasi.tahun', 'realisasi.nilai', 'dokumen.nama_dokumen')
                        ->get();

        // Check if data is empty
        if ($detail_dokumen->isEmpty()) {
            return view('karyawan.detail_dokumen', compact('detail_dokumen'))->with('error', 'Tidak Ada Data yang ditampilkan');
        }
        
        return view('karyawan.detail_dokumen', compact('detail_dokumen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $dokumen->inserted_by = $loggedInUser->username;
        $dokumen->updated_by = $loggedInUser->username;
        $dokumen->save();

        return redirect()->route('detail_dokumen')->with('success', 'Data berhasil dimasukkan dan ditambahkan dalam database');
    }
    
    public function upload(Request $request, $id)
    {
        $loggedInUser = Auth::user();
        $dokumen = Dokumen::find($id);

        $request->validate([
            'file' => 'required|mimes:pdf',
        ], [
            'file.required' => 'Nama Dokumen harus dimasukkan',
            'file.mimes' => 'Dokumen harus dalam format pdf',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $kodePenilaian = $request->input('kode_penilaian', $dokumen->kode_penilaian);

            $dokumen = new Dokumen;
            $dokumen->kode_penilaian = $kodePenilaian;
            $dokumen->inserted_by = $loggedInUser->username;
            $dokumen->updated_by = $loggedInUser->username;

            // Set the properties of the Dokumen model
            $dokumen->nama_dokumen = $file->getClientOriginalName();
            $dokumen->format_file = $file->getClientOriginalExtension();

            // Store the file in the 'public' disk
            Storage::putFileAs('app/public', $file, $file->getClientOriginalName());
        }

        $dokumen->save();

        // Pass $dokumen to the view
        return redirect()->route('detail_dokumen', ['id' => $id])->with('success', 'File dokumen berhasil dimasukkan dan ditambahkan dalam database')->with('dokumen', $dokumen);
    }

    public function showDokumen($id)
    {
        $loggedInUser = Auth::user();
        $kode_penilaian = $loggedInUser->kode_penilaian;

        // Mendapatkan dokumen sesuai dengan kode_penilaian yang terkait
        $dokumen = Dokumen::where('kode_penilaian', $kode_penilaian)->first();
    
        $detail_dokumen = DB::table('variabel_penilaian')
                        ->join('realisasi', 'variabel_penilaian.kode_penilaian', '=', 'realisasi.kode_penilaian')
                        ->join('dokumen', 'variabel_penilaian.kode_penilaian', '=', 'dokumen.kode_penilaian')
                        ->select('variabel_penilaian.*', 'realisasi.tahun', 'realisasi.nilai', 'dokumen.nama_dokumen')
                        ->get();

        return view('karyawan.detail_dokumen', compact('dokumen', 'detail_dokumen'));
    }

    public function lihatFile($id)
    {
        $dokumen = Dokumen::find($id);

        if (!$dokumen) {
            abort(404); // Handle jika dokumen tidak ditemukan
        }

        $filePath = 'app/public/' . $dokumen->nama_dokumen;

        return response()->file(storage_path($filePath));
    }

    public function edit($id)
    {
        $detail_dokumen = DB::find($id);

        return view('karyawan.detail_dokumen', compact('detail_dokumen'));
    }

    public function update(Request $request, $id)
    {
        // Mendapatkan pengguna yang terautentikasi
        $loggedInUser = Auth::user();

        $variabelPenilaian = VariabelPenilaian::find($id);
        $realisasi = Realisasi::find($id);

        if (!$variabelPenilaian || !$realisasi) {
            // Tangani kasus jika data tidak ditemukan
            // Misalnya, lemparkan exception atau berikan respon error
            return response()->json(['error' => 'Data not found'], 404);
        }

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
        $variabelPenilaian->update(['updated_by' => $loggedInUser->name]);
        $realisasi->update(['updated_by' => $loggedInUser->name]);

        // Simpan perubahan
        $variabelPenilaian->save();
        $realisasi->save();

        // Berikan respons sukses atau redirect sesuai kebutuhan Anda
        return redirect()->route('detail_dokumen', ['id' => $id])->with('success', 'Skor maksimal dan final berhasil dimasukkan dan ditambahkan dalam database');
    }

    public function delete($id)
    {
        $detail_dokumen = DB::find($id);

        return view('karyawan.detail_dokumen', compact('detail_dokumen'));
    }

    public function konfirmDelete($id)
    {
        $loggedInUser = Auth::user();

        $dokumen = Dokumen::find($id);
        $variabelPenilaian = VariabelPenilaian::find($id);
        $realisasi = Realisasi::find($id);

        // Hapus file terkait jika perlu (gantilah 'nama_dokumen' sesuai dengan kolom yang menyimpan nama file)
        $filePath = 'app/public/' . $dokumen->nama_dokumen;
        if (file_exists(storage_path($filePath))) {
            unlink(storage_path($filePath));
        }

        // Hapus record dari database
        $dokumen->delete();
        $variabelPenilaian->delete();
        $realisasi->delete();

        return redirect()->route('detail_dokumen')->with('success', 'Data deleted successfully.');
    }
}
