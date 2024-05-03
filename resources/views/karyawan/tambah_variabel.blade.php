<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <h3 class="font-weight-bold mb-0">Tambah Data Variabel Penilaian</h3>
            <hr class="horizontal mb-3 dark">
            <div class="row">
                <div class="col-md-10 mx-auto mb-3 card-center">
                    <div class="card shadow-s border mb-4">
                        <div class="card-body pt-4 p-3">
                            <form role="form" method="POST" action="{{ route('simpan_variabel') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <label for="versi" class="form-control-label">Versi</label>
                                    <div class="@error('versi')border border-danger rounded-3 @enderror">
                                        <input name="versi" class="form-control" type="text" placeholder="Masukkan versi dari dokumen" id="versi" value="{{ old('versi') }}">
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
                                <div class="form-group">
                                    <label for="nilai_maksimal" class="form-control-label">Skor Maksimal</label>
                                    <div class="@error('nilai_maksimal')border border-danger rounded-3 @enderror">
                                        <input name="nilai_maksimal"class="form-control" type="text" placeholder="Masukkan skor maksimal dari dokumen" id="nilai_maksimal" value="{{ old('nilai_maksimal') }}">
                                    </div>
                                    @error('nilai_maksimal') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="card-footer">
                                    <button href=/detail-variabel type="submit" class="btn btn-primary">Simpan</button>
                                    <a href=/detail-variabel class="btn btn-danger ms-2">Kembali</a>
                                </div>
                            </div>
                            </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-i1bII8fY8eB+j4StXjep9jlHTAdh4DSq