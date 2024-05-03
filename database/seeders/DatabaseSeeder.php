<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\VariabelPenilaian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Alec Thompson',
            'username' => 'Alec-123',
            'email' => 'alec123_@gmail.com',
            'password' => Hash::make('alec123_'),
            'konfirm_password' => Hash::make('alec123_'),
            'level' => 'Karyawan',
            'flag_deleted' => 0,
        ]);
        User::factory()->create([
            'name' => 'Subakti Wirawan Putra',
            'username' => 'Putra_11Wi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123_'),
            'konfirm_password' => Hash::make('admin123_'),
            'level' => 'Admin',
            'flag_deleted' => 0,
        ]);

        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Kebijakan Tata Kelola IT',
        //     'deskripsi_item_penilaian' => 'Kebijakan Tata kelola IT adalah dokumen atau kumpulan dokumen kebijakan yang dibuat untuk menjalankan tata IT perusahaan, baik itu yang jenisnya Kebijakan Strategis maupun Kebijakan Operasional.',
        //     'kode_penilaian' => 'EDM01',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Prosedur Penerapan Tata Kelola IT',
        //     'deskripsi_item_penilaian' => 'Dokumen atau bagian dari dokumen yang memuat aktivitas-aktivitas dalam penerapan tata kelola IT di perusahaan.',
        //     'kode_penilaian' => 'EDM01',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Model Pengambilan Keputusan IT',
        //     'deskripsi_item_penilaian' => 'Dokumen atau bagian dari dokumen yang berisi mekanisme pengambilan keputusan IT.',
        //     'kode_penilaian' => 'EDM01',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Mekanisme Komunikasi terkait Tata Kelola IT di Perusahaan',
        //     'deskripsi_item_penilaian' => 'Dokumen atau bagian dari dokumen yang terkait Tata Kelola IT di perusahaan yang memuat hasil monitoring Tata Kelola IT dan termasuk rencana komunikasinya.',
        //     'kode_penilaian' => 'EDM01',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Prosedur Pengelolaan Nilai/Benefit IT',
        //     'deskripsi_item_penilaian' => 'Dokumen atau bagian dari dokumen yang memuat aktivitas-aktivitas untuk melakukan pengelolaan benefit IT.',
        //     'kode_penilaian' => 'EDM02',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Pedoman Risk Management/ERM',
        //     'deskripsi_item_penilaian' => 'Dokumen yang memuat kerangka kerja dalam penerapan manajemen risiko di lingkungan perusahaan.',
        //     'kode_penilaian' => 'EDM03',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Prosedur Optimalisasi Sumber Daya (Anggaran, SDM, Kapasitas)',
        //     'deskripsi_item_penilaian' => 'Prosedur Optimalisasi Sumber Daya (Anggaran, SDM, Kapasitas)',
        //     'kode_penilaian' => 'EDM04',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Prosedur Pengelolaan Keterlibatan Stakeholder',
        //     'deskripsi_item_penilaian' => 'Dokumen atau bagian dari dokumen yang memuat aktivitas-aktivitas untuk melakukan evaluasi, pemberian arahan dan monitoring atas keterlibatan stakeholder dalam pelaksanaan tata kelola dan manajemen IT.',
        //     'kode_penilaian' => 'EDM05',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
        // VariabelPenilaian::create([
        //     'versi' => '1',
        //     'item_penilaian' => 'Prosedur Pelaporan IT',
        //     'deskripsi_item_penilaian' => 'Dokumen atau bagian dari dokumen yang memuat aktivitas-aktivitas untuk menyusun dan melaporkan semua laporan-laporan IT kepada stakeholder.',
        //     'kode_penilaian' => 'EDM05',
        //     'nilai_maksimal' => 5,
        //     'flag_delete' => 0,
        // ]);
    }
}
