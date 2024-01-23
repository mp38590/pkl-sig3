<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <hr class="horizontal mb-3 dark">
            <div class="row">
                <div class="col-md-12 mb-6">
                    <div class="card shadow-xs border mb-4">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-light btn-sm position-relative btn-md mt-3 mb-3 me-3" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="border: 2px solid #35A8CC;">+ Tambah
                            </button>

                            <!-- TAMBAH -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width: 800px; absolute; top: 50%; left: 50%; transform: translate(-49%);">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dokumen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('tambah_dokumen') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body pt-1 p-2">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="tahun" class="form-control-label">Tahun</label>
                                                <div class="@error('tahun')border border-danger rounded-3 @enderror">
                                                    <div class="input-group">
                                                        <input name="tahun" class="form-control" type="text" placeholder="Pilih tahun upload dokumen" id="tahun" value="{{ old('tahun') }}">
                                                        <button class="btn-light border rounded-1" type="button" name="datepicker" id="datepicker">
                                                            <img src="../assets/img/small-logos/calender.png" class="calender" style="width: 15px; height: 20px">
                                                        </button> 
                                                    </div>
                                                </div>
                                                @error('tahun') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="versi" class="form-control-label">Versi</label>
                                                <div class="@error('versi')border border-danger rounded-3 @enderror">
                                                    <input name="versi" class="form-control" type="text" placeholder="Masukkan versi dokumen" id="versi" value="{{ old('versi') }}">
                                                </div>
                                                @error('versi') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_penilaian" class="form-control-label">Kode Penilaian</label>
                                                <div class="@error('kode_penilaian')border border-danger rounded-3 @enderror">
                                                    <input name="kode_penilaian" class="form-control" type="text" placeholder="Masukkan kode penilaian dari dokumen" id="kode_penilaian" value="{{ old('kode_penilaian') }}">
                                                </div>
                                                @error('kode_penilaian') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="item_penilaian" class="form-control-label">Item Penilaian</label>
                                                <div class="@error('item_penilaian')border border-danger rounded-3 @enderror">
                                                    <input name="item_penilaian" class="form-control" type="text" placeholder="Masukkan item penilaian dari dokumen" id="item_penilaian" value="{{ old('item_penilaian') }}">
                                                </div>
                                                @error('item_penilaian') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi_item_penilaian" class="form-control-label">Deskripsi Penilaian</label>
                                                <div class="@error('deskripsi_item_penilaian')border border-danger rounded-3 @enderror">
                                                    <input name="deskripsi_item_penilaian"class="form-control" type="text" placeholder="Masukkan deskripsi item penilaian dari dokumen" id="deskripsi_item_penilaian" value="{{ old('deskripsi_item_penilaian') }}">
                                                </div>
                                                @error('deskripsi_item_penilaian') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="text-center">
                            @if (session('success'))
                                <div class="font-medium text-sm text-green-600 alert2 alert-success" role="alert2">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @error('error')
                                <div class="alert alert-danger text-sm" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                            <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                            <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Tahun</th>
                                            <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Versi</th>
                                            <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Kode Penilaian</th>
                                            <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">Item Penilaian</th>
                                            <th class="text-info text-s font-weight-semibold ps-4" style="text-align: center;">Skor Maksimal</th>
                                            <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Skor Final</th>
                                            <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Deskripsi Penilaian</th>
                                            <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nama Dokumen</th>
                                            <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Action</th>
                                        <!-- </span> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($detail_dokumen as $index => $data)
                                    <tr>
                                        <th class="font-weight-normal text-sm text-dark ps-3">{{ $index + 1 }}</th>
                                        <th class="font-weight-normal text-sm text-dark ps-0 me-4">{{ $data->tahun }}</th>
                                        <th class="font-weight-normal text-sm text-dark ps-1">{{ $data->versi }}</th>
                                        <th class="font-weight-normal text-sm text-dark ps-1">{{ $data->kode_penilaian }}</th>
                                        <th class="font-weight-normal text-sm text-dark ps-3">{{ $data->item_penilaian }}</th>
                                        <th class="font-weight-normal text-sm text-dark ps-4">{{ $data->nilai_maksimal }}</th>
                                        <th class="font-weight-normal text-sm text-dark ps-4">{{ $data->nilai }}</th>
                                        <th class="font-weight-normal text-sm text-dark ps-2 pe-2 expandable">{{ $data->deskripsi_item_penilaian }}</th>
                                        <th class="text-secondary text-xs font-weight-semibold ps-2 text-center">
                                        <button type="button" class="btn btn-dark btn-sm position-relative mt-1 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal2"
                                                style="width: 30px; height: 30px;">
                                                <img src="../assets/img/small-logos/upload.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                                    style="width: 15px; height: 15px;">
                                        </button>
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold ps-2">
                                        <button type="button" class="btn btn-primary btn-sm position-relative mt-1 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal3"
                                                style="width: 30px; height: 30px;">
                                                <img src="../assets/img/small-logos/dokumen.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                                    style="width: 17px; height: 17px;">
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm position-relative mt-1 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal4"
                                                style="width: 30px; height: 30px;">
                                                <img src="../assets/img/small-logos/tool.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                                    style="width: 15px; height: 15px;">
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm position-relative mt-1 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal6"
                                                style="width: 30px; height: 30px;">
                                                <img src="../assets/img/small-logos/eraser.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                                    style="width: 15px; height: 15px;">
                                        </button>
                                        </th>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- UPLOAD -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content2" style="width: 800px; absolute; top: 50%; left: 50%; transform: translate(-49%);">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Dokumen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @foreach($detail_dokumen as $detail)
                                <form role="form" method="POST" action="{{ route('upload_dokumen', ['id' => $detail->id]) }}" enctype="multipart/form-data">
                                @endforeach
                                @csrf
                                <div class="card-body pt-4 p-3">
                                    <div class="row">
                                        <label for="file" class="form-control-label">Nama Dokumen</label>
                                        <div class="@error('file') border border-danger rounded-3 @enderror">
                                            <div class="mb-3">
                                                <input class="form-control" type="file" name="file" id="file" multiple>
                                            </div>
                                        </div>
                                        @error('file') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>

                        <!-- VIEW -->
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 800px; absolute; top: 50%; left: 50%; transform: translate(-49%);">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">View Dokumen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="header font-weight-bold" style="font-size: 20px; color: black;">
                                    @foreach($detail_dokumen as $data)
                                    Tahun <span style="margin-left: 10px;"> : {{ $data->tahun }} <br> </span>
                                    Versi <span style="margin-left: 22px;"> : {{ $data->versi }} </span>
                                    @endforeach
                                </div>
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 mt-5">
                                        <thead>
                                            <tr>
                                                <!-- <span class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                                    <!-- <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault">
                                                    </div> -->
                                                    <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                                    <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nama Dokumen</th>
                                                    <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Inserted By</th>
                                                    <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Updated By</th>
                                                    <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Action</th>
                                                <!-- </span> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($detail_dokumen as $index => $data)
                                                <tr>
                                                    <th class="font-weight-normal text-sm text-dark ps-3">{{ $index + 1 }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-0 me-4">{{ $data->nama_dokumen }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-1">{{ $data->inserted_by }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-1">{{ $data->updated_by }}</th>
                                                    <th class="text-secondary text-xs font-weight-semibold ps-2">
                                                    <button type="button" class="btn btn-primary btn-sm position-relative mt-1 mb-1" style="width: 30px; height: 30px;">
                                                        <a href="{{ route('lihat_file', ['id' => $data->id]) }}" style="text-decoration: none; color: inherit;" target="_blank">
                                                            <img src="../assets/img/small-logos/dokumen.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 17px; height: 17px;">
                                                        </a>
                                                    </button>
                                                    </th>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- EDIT -->
                        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content3" style="width: 800px; absolute; top: 50%; left: 50%; transform: translate(-49%);">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Skor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @foreach($detail_dokumen as $detail)
                                <form role="form" method="POST" action="{{ route('update_skor', ['id' => $detail->id]) }}" enctype="multipart/form-data" >
                                @endforeach    
                                @csrf
                                    <div class="card-body pt-3 p-3">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="nilai_maksimal" class="form-control-label">Skor Maksimal</label>
                                                <div class="@error('nilai_maksimal')border border-danger rounded-3 @enderror">
                                                    <input name="nilai_maksimal" class="form-control" type="text" placeholder="Masukkan skor maksimal dari dokumen" id="nilai_maksimal" value="{{ old('nilai_maksimal') }}">
                                                </div>
                                                @error('nilai_maksimal') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nilai" class="form-control-label">Skor Final</label>
                                                <div class="@error('nilai')border border-danger rounded-3 @enderror">
                                                    <input name="nilai" class="form-control" type="text" placeholder="Masukkan skor final dari dokumen" id="nilai" value="{{ old('nilai') }}">
                                                </div>
                                                @error('nilai') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>

                        <!-- DELETE -->
                        <div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 800px; absolute; top: 50%; left: 50%; transform: translate(-49%);">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Hapus Dokumen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @foreach($detail_dokumen as $detail)
                                <form action="{{ route('konfirm_delete_dokumen', ['id' => $detail->id]) }}" method="POST">
                                @csrf
                                <div class="card-body pt-1 p-2">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="tahun" class="form-control-label">Tahun</label>
                                            <div class="@error('tahun')border border-danger rounded-3 @enderror">
                                                <input name="tahun" class="form-control" type="text" id="tahun" value="{{ $detail->tahun }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="versi" class="form-control-label">Versi</label>
                                            <div class="@error('versi')border border-danger rounded-3 @enderror">
                                                <input name="versi" class="form-control" type="text" placeholder="Masukkan versi dokumen" id="versi" value="{{ $detail->versi }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_penilaian" class="form-control-label">Kode Penilaian</label>
                                            <div class="@error('kode_penilaian')border border-danger rounded-3 @enderror">
                                                <input name="kode_penilaian" class="form-control" type="text" placeholder="Masukkan kode penilaian dari dokumen" id="kode_penilaian" value="{{ $detail->kode_penilaian }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="item_penilaian" class="form-control-label">Item Penilaian</label>
                                            <div class="@error('item_penilaian')border border-danger rounded-3 @enderror">
                                                <input name="item_penilaian" class="form-control" type="text" placeholder="Masukkan item penilaian dari dokumen" id="item_penilaian" value="{{ $detail->item_penilaian }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi_item_penilaian" class="form-control-label">Deskripsi Penilaian</label>
                                            <div class="@error('deskripsi_item_penilaian')border border-danger rounded-3 @enderror">
                                                <input name="deskripsi_item_penilaian"class="form-control" type="text" placeholder="Masukkan deskripsi item penilaian dari dokumen" id="deskripsi_item_penilaian" value="{{ $detail->deskripsi_item_penilaian }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="text-danger text-sm text-center" colspan="5">
                                    <p>Apakah Anda yakin ingin menghapus file di atas? Jika yakin silahkan klik hapus dan jika tidak ingin menghapus silahkan klik cancel</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="simpan" class="btn btn-primary">Hapus</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<br/>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $("#datepicker").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        autoclose: true
    }).on('changeYear', function (e) {
        // Tangani peristiwa perubahan tahun dan atur nilai input
        var selectedYear = e.date.getFullYear();
        document.getElementById('tahun').value = selectedYear;
    });;
});
</script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-rmok6Wzg7iVCIw7+/xBg5jUcUHRBpMSwqK2sI4gNOQcA+oBEtI7gAn5wMG8qPdGl" crossorigin="anonymous">

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-Q6G/M5EBdI94TQH2O3uhG5ZaFQZlT3IhBDc4TG8q9gqEn5uQzzrZf7p3Uld5G2eb" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-i1bII8fY8eB+j4StXjep9jlHTAdh4DSqiCpCwNj/rHyoNcI5L3D+X2FBEIIz3iRv" crossorigin="anonymous"></script>