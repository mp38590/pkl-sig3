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
                <div class="col-md-8 mx-auto mb-3 card-center">
                    <div class="card shadow-s border mb-4">
                    <form role="form" method="POST" action="{{ route('update_skor_admin', ['id_variabel_penilaian' => $realisasi->id_variabel_penilaian]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-body pt-4 p-3">
                        <div class="form-group">
                            <label for="tahun" class="form-control-label">Tahun</label>
                                <input name="tahun" class="form-control" type="text" id="tahun" value="{{ $realisasi->tahun }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="versi" class="form-control-label">Versi</label>
                                <input name="versi" class="form-control" type="text" id="versi" value="{{ $variabelPenilaian->versi }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="kode_penilaian" class="form-control-label">Kode Penilaian</label>
                                <input name="kode_penilaian" class="form-control" type="text" id="kode_penilaian" value="{{ $variabelPenilaian->kode_penilaian }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="item_penilaian" class="form-control-label">Item Penilaian</label>
                                <input name="item_penilaian" class="form-control" type="text" id="item_penilaian" value="{{ $variabelPenilaian->item_penilaian }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nilai_maksimal" class="form-control-label">Skor Maksimal</label>
                            <div class="@error('nilai_maksimal')border border-danger rounded-3 @enderror">
                                <input name="nilai_maksimal" class="form-control" type="text" id="nilai_maksimal" value="{{ $variabelPenilaian->nilai_maksimal }}" disabled>
                            </div>
                            @error('nilai_maksimal') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="nilai" class="form-control-label">Skor Final</label>
                            <div class="@error('nilai')border border-danger rounded-3 @enderror">
                                <input name="nilai" class="form-control" type="text" placeholder="{{ $realisasi->nilai ?? 'Masukkan skor final dari dokumen' }}" id="nilai" value="{{ old('nilai') }}">
                            </div>
                            @error('nilai') <div class="alertError2 text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="card-footer">
                            <button href=/detail-dokumen-admin type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>