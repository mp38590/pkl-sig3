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
                    <form role="form" method="POST" action="{{ route('update_skor') }}" enctype="multipart/form-data">
                    @csrf
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
                        <button href=/detail-dokumen type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>