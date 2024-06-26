<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
        <h3 class="font-weight-bold mb-0">Detail Dokumen</h3>
            <hr class="horizontal mb-3 dark">
            <div class="row">
                <div class="col-md-12 mb-6">
                    <div class="card shadow-s border mb-4">
                        <div class="text-center">
                            @if (session('success'))
                                <div class="font-medium text-sm text-green-600 alert2 alert-success" role="alert2">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="font-medium text-sm text-danger alert2 alert-danger" role="alert2">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <!-- <span class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                            <!-- <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                            </div> -->
                                            <th class="text-info text-lg font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Tahun</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Versi</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Kode Penilaian</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Item Penilaian</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Skor Maksimal</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Skor Final</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Deskripsi Penilaian</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Nama Dokumen</th>
                                            <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Action</th>
                                        <!-- </span> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($detail_dokumen as $key => $detail)
                                    <tr>
                                        <th class="font-weight-normal text-xl text-dark ps-3">{{ $detail_dokumen->firstItem() + $key}}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-1 me-4">{{ $detail->tahun }}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-1">{{ $detail->versi }}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-1">{{ $detail->kode_penilaian }}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-1">
                                            {!! nl2br(wordwrap($detail->item_penilaian, 20, "\n", true)) !!}
                                        </th>
                                        <th class="font-weight-normal text-xl text-dark ps-1 text-center">{{ $detail->nilai_maksimal }}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-1">{{ $detail->nilai }}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-2 pe-2" style="text-align: justify;">
                                            {!! nl2br(wordwrap($detail->deskripsi_item_penilaian, 30, "\n", true)) !!}
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold ps-1 text-center">
                                        <a href="{{ route('tambah_file_admin', ['id_variabel_penilaian' => $detail->id_variabel_penilaian]) }}" class="btn btn-dark btn-sm position-relative mt-1 mb-1" style="width: 40px; height: 32px;">
                                                <img src="../assets/img/small-logos/upload.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                                    style="width: 15px; height: 15px;">
                                        </a>
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold ps-1 text-center">
                                        <a href="{{ route('show_dokumen_admin', ['id_variabel_penilaian' => $detail->id_variabel_penilaian]) }}" class="btn btn-primary btn-sm position-relative mt-1 mb-1" style="width: 40px; height: 32px;">
                                                <img src="../assets/img/small-logos/dokumen.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                                    style="width: 17px; height: 17px;">
                                        </a> <br>
                                        <a href="{{ route('edit_skor_admin', ['id_variabel_penilaian' => $detail->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;">
                                                <img src="../assets/img/small-logos/tool.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                                    style="width: 15px; height: 15px;">
                                        </a> <br>
                                        <a href="{{ route('hapus_dokumen_admin', ['id_variabel_penilaian' => $detail->id_variabel_penilaian]) }}" class="btn btn-danger btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;">
                                                <img src="../assets/img/small-logos/eraser.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                                    style="width: 15px; height: 15px;">
                                        </a>
                                        </th>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-2 me-3 justify-content-end d-flex">
                                {{ $detail_dokumen->links() }}
                            </div>
                            <div class="me-3 justify-content-end d-flex">
                                Showing
                                {{ $detail_dokumen->firstItem() }}
                                to
                                {{ $detail_dokumen->lastItem() }}
                                of
                                {{ $detail_dokumen->total() }}
                                entries
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>