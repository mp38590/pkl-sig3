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
                <div class="col-md-10 mx-auto mb-3 card-center">
                    <div class="card shadow-s border mb-4">
                        <form role="form" method="POST" action="{{ route('update_data_profile', ['id' => $user->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card card-body pt-4 p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="@error('username')border border-danger rounded-3 @enderror">
                                            <input class="form-control" name="username" type="text" placeholder="Masukkan username Anda" id="username" value="{{ $user->username }}">
                                        </div>
                                        @error('username') <div class="alert text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik" class="form-label">Nomer Induk Kependudukan (NIK)</label>
                                        <div class="@error('nik') border border-danger rounded-3 @enderror">
                                            <input class="form-control" name="nik" type="text" placeholder="Masukkan Nomer Induk Kependudukan (NIK) Anda" id="nik" value="{{ $user->nik }}">
                                        </div>
                                        @error('nik') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <div class="@error('email')border border-danger rounded-3 @enderror">
                                            <input class="form-control" name="email" type="text" placeholder="Masukkan alamat email Anda" id="email" value="{{ $user->email }}">
                                        </div>
                                        @error('email') <div class="alert text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp" class="form-label">Nomer Telepon</label>
                                        <div class="@error('no_hp') border bor der-danger rounded-3 @enderror">
                                            <input class="form-control" name="no_hp"type="text" placeholder="Masukkan nomer telepon Anda" id="no_hp" value="{{ $user->no_hp }}">
                                        </div>
                                        @error('no_hp') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan" class="form-label">Jabatan</label>
                                        <div class="@error('jabatan') border border-danger rounded-3 @enderror">
                                            <input class="form-control" name="jabatan" type="text" placeholder="Masukkan jabatan Anda" id="jabatan" value="{{ $user->jabatan }}">
                                        </div>
                                        @error('jabatan') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_rekening" class="form-label">Nomer Rekening</label>
                                        <div class="@error('no_rekening')border border-danger rounded-3 @enderror">
                                            <input class="form-control" name="no_rekening" type="text" placeholder="Masukkan nomer rekening Anda" id="no_rekening" value="{{ $user->no_rekening }}">
                                        </div>
                                        @error('no_rekening') <div class="alert text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat_rumah" class="form-label">Alamat Rumah</label>
                                        <div class="@error('alamat_rumah') border border-danger rounded-3 @enderror">
                                            <textarea class="form-control" name="alamat_rumah" type="text" placeholder="Masukkan alamat rumah Anda" id="alamat_rumah" rows="3">{{ $user->alamat_rumah }}</textarea>
                                        </div>
                                        @error('alamat_rumah') <div class="alert text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card card-footer pe-3">
                                <button href="{{ route('show_profile', ['id' => $user->id]) }}" type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>