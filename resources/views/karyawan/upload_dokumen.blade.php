<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
        <h3 class="font-weight-bold mb-0">Tambah File Dokumen Assessment</h3>
            <hr class="horizontal mb-3 dark">
            <div class="row">
                <div class="col-md-8 mx-auto mb-3 card-center">
                    <div class="card shadow-s border mb-4">
                    @if (!is_null($dokumen->id_variabel_penilaian))
                    <form role="form" method="POST" action="{{ route('upload_dokumen', ['id_variabel_penilaian' => $dokumen->id_variabel_penilaian]) }}" enctype="multipart/form-data">
                    @endif
                    @csrf
                        <div class="card-body pt-4 p-3">
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
                                <label for="file" class="form-control-label">Nama Dokumen</label>
                                <div class="@error('file.*') border border-danger rounded-3 @enderror">
                                    <div class="mb-3">
                                        <input class="form-control" type="file" name="file[]" id="file" multiple>
                                    </div>
                                </div>
                                @error('file') <div class="text-danger">{{ $message }}</div> @enderror
                                @error('file.*') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        <div class="card-footer">
                            <button href=/detail-dokumen type="submit" class="btn btn-primary">Simpan</button>
                            <a href=/detail-dokumen class="btn btn-danger ms-2">Kembali</a>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>