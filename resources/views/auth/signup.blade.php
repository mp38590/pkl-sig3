<x-guest-layout>

    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 start-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute d-flex fixed-top ms-auto h-100 z-index-0 bg-cover me-n8"
                                    style="background-image:url('../assets/img/pabrik/kantor-sig2.jpg')">
                                    <div class="my-auto text-start max-width-350 ms-7">
                                        <h1 class="mt-3 text-white font-weight-bolder">Selamat Datang!</h1>
                                        <p class="text-white text-lg mt-4 mb-4">Silahkan Daftarkan Diri Anda agar Dapat Mengakses Seluruh Fitur pada Aplikasi SimL.</p>
                                        <!-- <div class="d-flex align-items-center">
                                            <div class="avatar-group d-flex">
                                                <a href="javascript:;" class="avatar avatar-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-original-title="Jessica Rowland">
                                                    <img alt="Image placeholder" src="../assets/img/team-3.jpg"
                                                        class="">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                                    <img alt="Image placeholder" src="../assets/img/team-4.jpg"
                                                        class="rounded-circle">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-original-title="Michael Lewis">
                                                    <img alt="Image placeholder" src="../assets/img/marie.jpg"
                                                        class="rounded-circle">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                                    <img alt="Image placeholder" src="../assets/img/team-1.jpg"
                                                        class="rounded-circle">
                                                </a>
                                            </div>
                                            <p class="font-weight-bold text-white text-sm mb-0 ms-2">Join 2.5M+ users
                                            </p>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-6">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6">Daftar</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="sign-up">
                                        @csrf
                                        <label>Nama</label>
                                        <div class="mb-3">
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Masukkan nama Anda" value="{{old("name")}}" aria-label="Name"
                                                aria-describedby="name-addon">
                                            @error('name')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Username</label>
                                        <div class="mb-3">
                                            <input type="text" id="username" name="username" class="form-control"
                                                placeholder="Masukkan username Anda" value="{{old("username")}}" aria-label="Username"
                                                aria-describedby="username-addon">
                                            @error('username')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Alamat Email</label>
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Masukkan alamat email Anda" value="{{old("email")}}" aria-label="Email"
                                                aria-describedby="email-addon">
                                            @error('email')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Level</label>
                                        <div class="mb-3">
                                            <input type="level" id="level" name="level" class="form-control"
                                                placeholder="Masukkan level pekerjaan Anda" value="{{old("level")}}" aria-label="Level"
                                                aria-describedby="level-addon">
                                            @error('level')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Masukkan password Anda" value="{{old("password")}}" aria-label="Password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Konfirmasi Password</label>
                                        <div class="mb-3">
                                            <input type="konfirm_password" id="konfirm_password" name="konfirm_password" class="form-control"
                                                placeholder="Masukkan konfirmasi password Anda" value="{{old("konfirm_password")}}" aria-label="Konfirm Password"
                                                aria-describedby="konfirm_password-addon">
                                            @error('konfirm_password')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-check form-check-info text-left mb-0">
                                            <input class="form-check-input" type="checkbox" name="terms"
                                                id="terms" required>
                                            <label class="font-weight-normal text-dark mb-0" for="terms">
                                                Saya setuju dengan <a href="javascript:;"
                                                    class="text-dark font-weight-bold">Syarat dan Ketentuan</a>.
                                            </label>
                                            @error('terms')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Daftar</button>
                                            <!-- <button type="button" class="btn btn-white btn-icon w-100 mb-3">
                                                <span class="btn-inner--icon me-1">
                                                    <img class="w-5" src="../assets/img/logos/google-logo.svg"
                                                        alt="google-logo" />
                                                </span>
                                                <span class="btn-inner--text">Sign up with Google</span>
                                            </button> -->
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Sudah memiliki akun?
                                        <a href="{{ route('sign-in') }}" class="text-dark font-weight-bold">Masuk</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>
