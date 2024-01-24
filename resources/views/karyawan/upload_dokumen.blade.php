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
                    <form role="form" method="POST" action="{{ route('upload_dokumen') }}" enctype="multipart/form-data">
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
                        <button href=/detail-dokumen type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>