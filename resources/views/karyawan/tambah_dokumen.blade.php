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
                    <div class="card shadow-s border mb-4">
                    <form role="form" method="POST" action="{{ route('simpan_dokumen') }}" enctype="multipart/form-data">
                    @csrf
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
                            <select name="versi" class="form-select" aria-label="Default select example">
                                <option selected>--Pilih Versi Dokumen--</option>
                                <option value="1" @if (old('versi') == '1') selected @endif>1</option>
                                <option value="2" @if (old('versi') == '2') selected @endif>2</option>
                                <option value="3" @if (old('versi') == '3') selected @endif>3</option>
                                <option value="4" @if (old('versi') == '4') selected @endif>4</option>
                                <option value="5" @if (old('versi') == '5') selected @endif>5</option>
                                <option value="6" @if (old('versi') == '6') selected @endif>6</option>
                                <option value="7" @if (old('versi') == '7') selected @endif>7</option>
                                <option value="8" @if (old('versi') == '8') selected @endif>8</option>
                                <option value="9" @if (old('versi') == '9') selected @endif>9</option>
                                <option value="10" @if (old('versi') == '10') selected @endif>10</option>
                                <option value="11" @if (old('versi') == '11') selected @endif>11</option>
                                <option value="12" @if (old('versi') == '12') selected @endif>12</option>
                                <option value="13" @if (old('versi') == '13') selected @endif>13</option>
                                <option value="14" @if (old('versi') == '14') selected @endif>14</option>
                            </select>
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
                        <button href=/detail-dokumen type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
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