<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <hr class="horizontal mb-3 dark">
            <div class="row">
                <div class="col-md-12 mb-6">
                    <div class="card shadow-s border mb-4">
                        <div class="card-body pt-4 p-3">
                            <div class="header font-weight-bold" style="font-size: 20px; color: black;">
                            <span style="margin-left: 10px;">Tahun <span style="margin-left: 10px;">:</span>
                                @if(isset($realisasi))
                                    <span style="margin-left: 10px;">{{ $realisasi->tahun }}</span>
                                @else
                                    <span style="margin-left: 10px;"> </span>
                                @endif
                                <br>
                            <span style="margin-left: 10px;">Versi <span style="margin-left: 20px;">:</span>
                                @if(isset($variabelPenilaian))
                                    <span style="margin-left: 10px;">{{ $variabelPenilaian->versi }}</span>
                                @else
                                    <span style="margin-left: 10px;"> </span>
                                @endif
                                <br>
                                @if (session('success'))
                                    <div class="font-medium text-sm text-green-600 alert2 alert-success mt-5 text-center" role="alert2">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 mt-4">
                                    <thead>
                                        <tr>
                                            <!-- <span class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                                <!-- <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                </div> -->
                                                <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                                <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nama Dokumen</th>
                                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">FIle</th>
                                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Verifikasi</th>
                                                <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Action</th>
                                            <!-- </span> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $index = 0
                                        @endphp
                                        @forelse($dokumen as $key => $dok)
                                        <tr>
                                            <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $loop->iteration }}</th>
                                            <th class="font-weight-normal text-sm text-dark ps-2 me-4">{{ $dok->nama_dokumen }}</th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2 text-center">
                                                @if($dok->nama_dokumen !== null)
                                                    <button type="button" class="btn btn-primary btn-sm position-relative mt-1 mb-1" style="width: 30px; height: 30px;">
                                                        <a href="{{ route('lihat_file_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian, 'nama_dokumen' => $dok->nama_dokumen]) }}" style="text-decoration: none; color: inherit;" target="_blank">
                                                            <img src="../assets/img/small-logos/dokumen.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 17px; height: 17px;">
                                                        </a>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-sm position-relative mt-1 mb-1" style="width: 30px; height: 30px;" disabled>
                                                        <a href="#" style="text-decoration: none; color: inherit;" target="_blank">
                                                            <img src="../assets/img/small-logos/dokumen.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 17px; height: 17px;">
                                                        </a>
                                                    </button>
                                                @endif
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2 text-center">
                                                @if ($dok->status == "approve")
                                                    <a href="{{ route('update_status_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian, 'nama_dokumen' => $dok->nama_dokumen]) }}" class="btn btn-success btn-sm position-relative mt-1 mb-1 text-center" disabled>Disetujui</a>&nbsp;
                                                @else
                                                    @if ($dok->nama_dokumen !== null)
                                                        <a href="{{ route('update_status_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian, 'nama_dokumen' => $dok->nama_dokumen]) }}" class="btn btn-danger btn-sm position-relative mt-1 mb-1 text-center">Belum Disetujui</a>&nbsp;
                                                    @else
                                                        <button class="btn btn-danger btn-sm position-relative mt-1 mb-1 text-center" disabled>Belum Disetujui</button>&nbsp;
                                                    @endif
                                                @endif
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2 text-center">
                                                @if ($dok->status == "approve")
                                                    <button href="{{ route('edit_skor_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                        <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                    </button>
                                                    <!-- <button href="{{ route('hapus_dokumen_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian]) }}" class="btn btn-danger btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                        <img src="../assets/img/small-logos/eraser.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 15px; height: 15px;">
                                                    </button> -->
                                                @else
                                                    @if ($dok->nama_dokumen !== null)
                                                        <a href="{{ route('edit_skor_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;">
                                                            <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                        </a>
                                                        <!-- <a href="{{ route('hapus_dokumen_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian]) }}" class="btn btn-danger btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;">
                                                            <img src="../assets/img/small-logos/eraser.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 15px; height: 15px;">
                                                        </a> -->
                                                    @else
                                                        <button href="{{ route('edit_skor_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                            <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                        </button>
                                                        <!-- <button href="{{ route('hapus_dokumen_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian]) }}" class="btn btn-danger btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                            <img src="../assets/img/small-logos/eraser.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 15px; height: 15px;">
                                                        </button> -->
                                                    @endif
                                                @endif
                                            </th>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-sm">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>