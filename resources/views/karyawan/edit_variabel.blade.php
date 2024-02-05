<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
    <x-app.navbar />
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <hr class="horizontal mb-3 dark">
            <div class="row">
                <div class="col-md-8 mx-auto mb-3 card-center">
                    <div class="card shadow-s border mb-4">
                    <form role="form" method="POST" action="{{ route('update_variabel', ['id' => $variabelPenilaian->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-body pt-4 p-3">
                        <div class="form-group">
                            <label for="versi" class="form-control-label">Versi</label>
                            <div class="@error('versi')border border-danger rounded-3 @enderror">
                                <input name="versi" class="form-control" type="text" placeholder="Masukkan versi dari dokumen" id="versi" value="{{ $variabelPenilaian->versi }}">
                            </div>
                            @error('versi') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_penilaian" class="form-control-label">Kode Penilaian</label>
                            <div class="@error('kode_penilaian')border border-danger rounded-3 @enderror">
                                <input name="kode_penilaian" class="form-control" type="text" placeholder="Masukkan kode penilaian dari dokumen" id="kode_penilaian" value="{{ $variabelPenilaian->kode_penilaian }}">
                            </div>
                            @error('kode_penilaian') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="item_penilaian" class="form-control-label">Item Penilaian</label>
                            <div class="@error('item_penilaian')border border-danger rounded-3 @enderror">
                                <input name="item_penilaian" class="form-control" type="text" placeholder="Masukkan item penilaian dari dokumen" id="item_penilaian" value="{{ $variabelPenilaian->item_penilaian }}">
                            </div>
                            @error('item_penilaian') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_item_penilaian" class="form-control-label">Deskripsi Penilaian</label>
                            <div class="@error('deskripsi_item_penilaian')border border-danger rounded-3 @enderror">
                                <input name="deskripsi_item_penilaian"class="form-control" type="text" placeholder="Masukkan deskripsi item penilaian dari dokumen" id="deskripsi_item_penilaian" value="{{ $variabelPenilaian->deskripsi_item_penilaian }}">
                            </div>
                            @error('deskripsi_item_penilaian') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="nilai_maksimal" class="form-control-label">Skor Maksimal</label>
                            <div class="@error('nilai_maksimal')border border-danger rounded-3 @enderror">
                                <input name="nilai_maksimal"class="form-control" type="text" placeholder="Masukkan skor maksimal dari dokumen" id="nilai_maksimal" value="{{ $variabelPenilaian->nilai_maksimal }}">
                            </div>
                            @error('nilai_maksimal') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="card card-footer pe-3">
                            <button href=/detail-variabel type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>