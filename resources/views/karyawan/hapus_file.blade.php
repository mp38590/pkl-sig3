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
                        <div class="card-body pt-4 p-3">
                            <form role="form" method="POST" action="{{ route('konfirm_hapus_file', ['id' => $dokumen->id, 'nama_dokumen' => $dokumen->nama_dokumen]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="versi" class="form-control-label">Versi</label>
                                <div class="@error('versi')border border-danger rounded-3 @enderror">
                                    <input name="versi" class="form-control" type="text" id="versi" value="{{ $dokumen->versi }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kode_penilaian" class="form-control-label">Kode Penilaian</label>
                                <div class="@error('kode_penilaian')border border-danger rounded-3 @enderror">
                                    <input name="kode_penilaian" class="form-control" type="text" id="kode_penilaian" value="{{ $dokumen->kode_penilaian }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="item_penilaian" class="form-control-label">Item Penilaian</label>
                                <div class="@error('item_penilaian')border border-danger rounded-3 @enderror">
                                    <input name="item_penilaian" class="form-control" type="text" id="item_penilaian" value="{{ $dokumen->item_penilaian }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_item_penilaian" class="form-control-label">Deskripsi Penilaian</label>
                                <div class="@error('deskripsi_item_penilaian')border border-danger rounded-3 @enderror">
                                    <input name="deskripsi_item_penilaian"class="form-control" type="text" id="deskripsi_item_penilaian" value="{{ $dokumen->deskripsi_item_penilaian }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_dokumen" class="form-control-label">Nama Dokumen</label>
                                <div class="@error('nama_dokumen')border border-danger rounded-3 @enderror">
                                    <input name="nama_dokumen"class="form-control" type="text" id="nama_dokumen" value="{{ $dokumen->nama_dokumen }}" disabled>
                                </div>
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