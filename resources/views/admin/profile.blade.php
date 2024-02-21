<x-app-layout>

    <x.app.navbar />
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <div class="pt-7 pb-6 bg-cover"
            style="background-image: url('../assets/img/header-orange-purple.jpg'); background-position: bottom;">
        </div>
        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div
                            class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            <img src="{{ asset('uploads/profiles/' . $user->foto) }}" alt="profile_image" class="w-100">
                            <button type="button" class="btn btn-white btn-sm position-absolute top-0 end-0 start-0 mt-8 ms-8 translate-middle border-2" style="width: 30px; height: 30px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img src="../assets/img/small-logos/pen.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle"
                                    style="width: 17px; height: 17px;">
                            </button>
                        </div>
                    </div>
                    <!-- MODAL -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form role="form" method="POST" action="{{ route('update_profile_admin', ['id' => $user->id]) }}" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <div class="@error('name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" name="name" type="text" placeholder="Masukkan nama lengkap Anda" id="name" value="{{ $user->name }}">
                                    </div>
                                    @error('email') <div class="alert text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="level" class="form-control-label">Level</label>
                                        <input name="level" class="form-control" type="text" id="level" value="{{ $user->level }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="file" class="form-control-label">Profile</label>
                                    <div class="@error('file') border border-danger rounded-3 @enderror">
                                        <div class="mb-3">
                                            <input class="form-control" type="file" name="file" id="file">
                                        </div>
                                    </div>
                                    @error('file') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h3 class="mb-0 font-weight-bold">
                                {{ $user->name }}
                            </h3>
                            <p class="mb-0">
                                {{ $user->level }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3 py-3">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Data Pribadi Anda</h6>
                                    <p class="text-sm mb-1">Silahkan lihat data pribadi yang telah tersedia dan jika ada kesalahan silkan klik tombol edit untuk melakukan perubahan.</p>
                                </div>
                                <div class="col-md-4 col-3 text-end">
                                    <a href="{{ route('edit_data_profile_admin', ['id' => $user->id]) }}" class="btn btn-white btn-icon px-2 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                    <span class="text-secondary">Username:</span> &nbsp; {{ $user->username }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Email:</span> &nbsp; {{ $user->email }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Nomer Telepon:</span> &nbsp; {{ $user->no_hp }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Alamat Rumah:</span> &nbsp; {{ $user->alamat_rumah }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Jabatan:</span> &nbsp; {{ $user->jabatan }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Nomer Rekening:</span> &nbsp; {{ $user->no_rekening }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>