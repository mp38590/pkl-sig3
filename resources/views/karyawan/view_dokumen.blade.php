<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
            <div class="container my-3 py-3">
            <h3 class="font-weight-bold mb-0">Daftar Dokumen Assessment</h3>
                <hr class="horizontal mb-3 dark">
                <!-- Nav pills -->
                <nav class="nav nav-pills">
                    <li class="nav-item">
                        <a href="#home" class="nav-item nav-link active" data-bs-toggle="pill">
                            <i class="fas fa-check"></i> Disetujui
                        </a>
                    <li>
                    <li class="nav-item">
                        <a href="#profile" class="nav-item nav-link" data-bs-toggle="pill">
                            <i class="fas fa-close"></i> Belum Disetujui
                        </a>
                    <li>
                </nav>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <div class="col-md-12 mb-6">
                            <div class="card shadow-xs border mb-4">
                                <div class="header font-weight-bold ms-3 mt-3" style="font-size: 20px; color: black;">
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
                                </div>
                                <div class="table-responsive p-0 mt-4">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                                <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nama Dokumen</th>
                                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Inserted By</th>
                                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Updated By</th>
                                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">File</th>
                                                <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @php
                                                $index = 0
                                                @endphp
                                                @foreach($dokumen as $key => $dok)
                                                @if($dok->status == 'approve')
                                                <tr>
                                                    <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $loop->iteration }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-2 me-4">{{ $dok->nama_dokumen }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-1 text-center">{{ $dok->inserted_by }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-1 text-center">{{ $dok->updated_by }}</th>
                                                    <th class="text-secondary text-xs font-weight-semibold pe-4 text-center">
                                                    @if($dok->nama_dokumen !== null)
                                                        <button type="button" class="btn btn-primary btn-sm position-relative mt-1 mb-1" style="width: 30px; height: 30px;">
                                                            <a href="{{ route('lihat_file', ['id_variabel_penilaian' => $dok->id_variabel_penilaian, 'nama_dokumen' => $dok->nama_dokumen]) }}" style="text-decoration: none; color: inherit;" target="_blank">
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
                                                    <th class="text-secondary text-xs font-weight-semibold pe-4 text-center">
                                                    @if ($dok->status == "approve")
                                                        <button href="{{ route('edit_file', ['id_variabel_penilaian' => $dokN->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                            <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                        </button>
                                                    @else
                                                        @if ($dok->nama_dokumen !== null)
                                                            <button href="{{ route('edit_file', ['id_variabel_penilaian' => $dokN->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                                <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                            </button>
                                                        @else
                                                            <button href="{{ route('edit_file', ['id_variabel_penilaian' => $dokN->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                                <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                            </button>
                                                        @endif
                                                    @endif
                                                    </th>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @if($dokumen->where('status', 'approve')->isEmpty())
                                                    <td colspan="10" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="mt-2 me-3 justify-content-end d-flex">
                                        {{ $dokumen->links() }}
                                    </div>
                                    <div class="me-3 text-sm font-weight-normal justify-content-end d-flex">
                                        Showing
                                        {{ $dokumen->firstItem() }}
                                        to
                                        {{ $dokumen->lastItem() }}
                                        of
                                        {{ $dokumen->total() }}
                                        entries
                                    </div>
                                    <div class="card-footer">
                                        <a href=/detail-dokumen class="btn btn-danger ms-2 mt-3 me-3">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="profile" class="container tab-pane fade"><br>
                <div class="col-md-12 mb-6">
                    <div class="card shadow-xs border mb-4">
                        <div class="header font-weight-bold ms-3 mt-3" style="font-size: 20px; color: black;">
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
                        </div>
                        <div class="table-responsive p-0 mt-4">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                        <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nama Dokumen</th>
                                        <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Inserted By</th>
                                        <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Updated By</th>
                                        <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">File</th>
                                        <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($dokumenN as $key => $dokN)
                                        @if($dokN->status == 'not approve')
                                        <tr>
                                            <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $loop->iteration }}</th>
                                            <th class="font-weight-normal text-sm text-dark ps-2 me-4">{{ $dokN->nama_dokumen }}</th>
                                            <th class="font-weight-normal text-sm text-dark ps-1 text-center">{{ $dokN->inserted_by }}</th>
                                            <th class="font-weight-normal text-sm text-dark ps-1 text-center">{{ $dokN->updated_by }}</th>
                                            <th class="text-secondary text-xs font-weight-semibold pe-4 text-center">
                                            @if($dokN->nama_dokumen !== null)
                                                <button type="button" class="btn btn-primary btn-sm position-relative mt-1 mb-1" style="width: 30px; height: 30px;">
                                                    <a href="{{ route('lihat_file', ['id_variabel_penilaian' => $dokN->id_variabel_penilaian, 'nama_dokumen' => $dokN->nama_dokumen]) }}" style="text-decoration: none; color: inherit;" target="_blank">
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
                                            <th class="text-secondary text-xs font-weight-semibold pe-4 text-center">
                                                @if ($dokN->status == "approve")
                                                    <button href="{{ route('edit_file', ['id_variabel_penilaian' => $dokN->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                        <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                    </button>
                                                @else
                                                    @if ($dokN->nama_dokumen !== null)
                                                        <a href="{{ route('edit_file', ['id_variabel_penilaian' => $dokN->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;">
                                                            <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                        </a>
                                                    @else
                                                        <button href="{{ route('edit_file', ['id_variabel_penilaian' => $dokN->id_variabel_penilaian]) }}" class="btn btn-warning btn-sm position-relative mt-1 mb-1 text-center" style="width: 40px; height: 32px;" disabled>
                                                            <img src="../assets/img/small-logos/editDok.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                                                        </button>
                                                    @endif
                                                @endif
                                            </th>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @if($dokumenN->where('status', 'not approve')->isEmpty())
                                            <td colspan="10" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-2 me-3 justify-content-end d-flex">
                                {{ $dokumenN->links() }}
                            </div>
                            <div class="me-3 text-sm font-weight-normal justify-content-end d-flex">
                                Showing
                                {{ $dokumenN->firstItem() }}
                                to
                                {{ $dokumenN->lastItem() }}
                                of
                                {{ $dokumenN->total() }}
                                entries
                            </div>
                            <div class="card-footer">
                                <a href=/detail-dokumen class="btn btn-danger ms-2 mt-3 me-3">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script>
    $(document).ready(function(){
    // Tangkap klik pada tombol pagination dengan kelas .pagination a
    $('.pagination a').on('click', function(e){
        // Hentikan aksi default dari link
        e.preventDefault();
        // Ambil href dari link
        var url = $(this).attr('href');
        // Perbarui URL dengan menambahkan hash '#profile'
        history.pushState({}, '', '#profile');
        // Simpan informasi tentang tab yang sedang aktif
        var activeTab = $('.nav-tabs .active').attr('href');
        // Muat konten dari URL menggunakan AJAX
        $.get(url, function(response){
            // Ubah isi dari div dengan ID 'profile' dengan konten yang dimuat
            $('#profile').html($(response).find('#profile').html());
            // Aktifkan kembali tab yang sedang aktif sebelumnya
            $('.nav-tabs a[href="'+activeTab+'"]').tab('show');
        });
    });
});


</script>

<script src="{{ asset('js/custom.js') }}"></script>

</x-app-layout>