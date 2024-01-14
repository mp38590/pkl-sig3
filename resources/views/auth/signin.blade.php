<x-guest-layout>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <div class="col-md-10">
            <div class="position-relative w-100">
                <div class="oblique-image position-absolute fixed-top start-50 translate-middle-x z-index-0 bg-cover"
                    style="width: 150vw; height: 100vh; background-image:url('../assets/img/pabrik/kantor.jpg')">
                    </div>
                        <!-- <div class="position-absolute top-0 start-50 translate-middle-x z-index-1 p-4 text-center text-white">
                            <h2 class="mt-3 text-dark font-weight-bold">Enter our global community of developers.</h2>
                            <h6 class="text-dark text-sm mt-5">Copyright © 2022 Corporate UI Design System by Creative Tim.</h6>
                        </div> -->
                    </div>
                </div>
            </div>
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-7">
                                <div class="card-header pb-0 text-left bg-transparent text-center">
                                <img src="../assets/img//logos/Ellipse.png" alt="Logo" class="rounded-circle position-absolute start-20 translate-middle-x"
                                    style="width: 100px; height: 100px; border: 3px solid #000000;">
                                    <h3 class="font-weight-black text-dark display-6 mt-8">Welcome back!!!</h3>
                                    <p class="mb-0" style="color: #ffffff">Create a New Account<br></p>
                                    <p class="mb-0" style="color: #ffffff">OR Sign In</p>
                                </div>
                                <div class="text-center">
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @error('message')
                                        <div class="alert alert-danger text-sm" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <form role="form" class="text-start" method="POST" action="sign-in">
                                        @csrf
                                        <label>Username</label>
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your email address"
                                                value="{{ old('email') ? old('email') : 'alec123_@gmail.com' }}"
                                                aria-label="Email" aria-describedby="email-addon">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password"
                                                value="{{ old('password') ? old('password') : 'alec123_' }}"
                                                class="form-control" placeholder="Enter password" aria-label="Password"
                                                aria-describedby="password-addon">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-check-info text-left mb-0">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" style="border: 3px solid #27C9D3; background-color: transparent; opacity: 0.7;">
                                                <label class="font-weight-normal text-primary mb-0" for="flexCheckDefault">
                                                    Remember Me
                                                </label>
                                            </div>
                                            <a href="{{ route('password.request') }}"
                                                class="text-xs font-weight-bold ms-auto text-primary">Forgot
                                                password</a>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Sign in</button>
                                            <button type="button" class="btn btn-white btn-icon w-100 mb-3">
                                                <span class="btn-inner--icon me-1">
                                                    <img class="w-5" src="../assets/img/logos/google-logo.svg"
                                                        alt="google-logo" />
                                                </span>
                                                <span class="btn-inner--text">Sign in with Google</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto text-secondary">
                                        Don't have an account?
                                        <a href="{{ route('sign-up') }}" class="text-secondary font-weight-bold" style="text-decoration: underline; text-decoration-thickness: 1px;">Sign up</a>
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
