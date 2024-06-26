<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
        <h3 class="font-weight-bold mb-0">Hapus Data Realisasi dan Dokumen</h3>
            <hr class="horizontal mb-3 dark">
            <div class="row">
                <div class="col-md-8 mx-auto mb-3 card-center">
                    <div class="card shadow-s border mb-4">
                        <div class="card-body pt-4 p-3">
                            @foreach($dokumen as $dok)
                            <form role="form" method="POST" action="{{ route('konfirm_hapus_dokumen', ['id_variabel_penilaian' => $dok->id_variabel_penilaian]) }}" enctype="multipart/form-data">
                            @endforeach
                            @csrf
                                <div class="form-group">
                                    <label for="tahun" class="form-control-label">Tahun</label>
                                        <input name="tahun" class="form-control" type="text" id="tahun" value="{{ $realisasi->tahun }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="versi" class="form-control-label">Versi</label>
                                        <input name="versi" class="form-control" type="text" id="versi" value="{{ $variabelPenilaian->versi }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nilai_maksimal" class="form-control-label">Skor Maksimal</label>
                                        <input name="nilai_maksimal" class="form-control" type="text" id="nilai_maksimal" value="{{ $variabelPenilaian->nilai_maksimal }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label">Skor Final</label>
                                        <input name="nilai" class="form-control" type="text" id="nilai" value="{{ $realisasi->nilai }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nama_dokumen" class="form-control-label">Nama Dokumen</label>
                                    <select name="nama_dokumen" id="nama_dokumen" class="form-control">
                                        <option value="">-- Pilih Nama File Dokumen -- </option>
                                        @foreach($dokumen as $document)
                                            <option value="{{ $document->nama_dokumen }}">{{ $document->nama_dokumen }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <h6 class="text-danger text-center ms-4 me-4 mb-3">Apakah Anda yakin ingin menghapus file di atas? Jika yakin silahkan jika tidak ingin menghapus silahkan klik cancel</h6>
                                <div class="card-footer">
                                    <button href=/detail-dokumen type="submit" class="btn btn-primary">Hapus</button>
                                    <a href=/detail-dokumen class="btn btn-danger ms-2">Kembali</a>
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