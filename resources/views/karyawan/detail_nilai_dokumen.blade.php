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
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 mt-5">
                                    <thead>
                                        <tr>
                                            <!-- <span class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                                <!-- <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                </div> -->
                                                <th class="text-info text-lg font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                                <th class="text-info text-lg font-weight-semibold ps-2" style="text-align: center;">Tahun</th>
                                                <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Versi</th>
                                                <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Kode Penilaian</th>
                                                <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Item Penilaian</th>
                                                <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Deskripsi Item Penilaian</th>
                                                <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Skor Final</th>
                                            <!-- </span> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($nilai_dokumen as $key => $nilai)
                                    <tr>
                                        <th class="font-weight-normal text-xl text-dark ps-3">{{ $nilai_dokumen->firstItem() + $key}}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-0 me-4">{{ $nilai->tahun }}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-1">{{ $nilai->versi }}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-1">{{ $nilai->kode_penilaian }}</th>
                                        <th class="font-weight-normal text-xl text-dark ps-2">
                                            {!! nl2br(wordwrap($nilai->item_penilaian, 20, "\n", true)) !!}
                                        </th>
                                        <th class="font-weight-normal text-xl text-dark ps-2 pe-2" style="text-align: justify;">
                                            {!! nl2br(wordwrap($nilai->deskripsi_item_penilaian, 30, "\n", true)) !!}
                                        </th>
                                        <th class="font-weight-normal text-xl text-dark ps-4">{{ $nilai->nilai }}</th>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
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