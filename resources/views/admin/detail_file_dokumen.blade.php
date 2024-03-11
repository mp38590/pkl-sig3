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
                                                <th class="text-info text-lg font-weight-semibold ps-2" style="text-align: center;">Nama Dokumen</th>
                                                <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Inserted By</th>
                                                <th class="text-info text-lg font-weight-semibold ps-1" style="text-align: center;">Updated By</th>
                                                <th class="text-info text-lg font-weight-semibold ps-2" style="text-align: center;">Action</th>
                                            <!-- </span> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $index = 0
                                        @endphp
                                        @foreach($dokumen as $dok)
                                        <tr>
                                            <th class="font-weight-normal text-xl text-dark ps-3">{{ $loop->iteration }}</th>
                                            <th class="font-weight-normal text-xl text-dark ps-2 me-4">{{ $dok->nama_dokumen }}</th>
                                            <th class="font-weight-normal text-xl text-dark ps-1">{{ $dok->inserted_by }}</th>
                                            <th class="font-weight-normal text-xl text-dark ps-1">{{ $dok->updated_by }}</th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2 text-center">
                                            <button type="button" class="btn btn-primary btn-sm position-relative mt-1 mb-1" style="width: 30px; height: 30px;">
                                                <a href="{{ route('lihat_file_admin', ['id_variabel_penilaian' => $dok->id_variabel_penilaian, 'nama_dokumen' => $dok->nama_dokumen]) }}" style="text-decoration: none; color: inherit;" target="_blank">
                                                    <img src="../assets/img/small-logos/dokumen.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 17px; height: 17px;">
                                                </a>
                                            </button>
                                            </th>
                                        </tr>
                                        @endforeach
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