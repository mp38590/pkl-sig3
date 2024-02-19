<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<nav class="navbar bg-slate-900 navbar-expand-lg flex-wrap top-0 px-0 py-0">
    <div class="container py-2">
        <nav aria-label="breadcrumb">
            <div class="d-flex align-items-center">
                <span class="px-3 font-weight-bold text-lgg text-white me-4">SIG</span>
            </div>
        </nav>
        <ul class="navbar-nav d-none d-lg-flex">
            @if (auth()->user()->level=="Karyawan")
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('dashboard_karyawan') }}" class="nav-link text-white p-0 text-lg">
                    Dashboard
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('detail_variabel') }}" class="nav-link text-white p-0 text-lg">
                    Detail Variabel Penilaian
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('detail_dokumen') }}" class="nav-link text-white p-0 text-lg">
                    Detail Dokumen
                </a>
            </li>
            @endif

            @if (auth()->user()->level=="Admin")
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('dashboard_admin') }}" class="nav-link text-white p-0 text-lg">
                    Dashboard
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('verifikasi_dokumen') }}" class="nav-link text-white p-0 text-lg">
                    Verifikasi Dokumen
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('data_pengguna') }}" class="nav-link text-white p-0 text-lg">
                    Data Pengguna
                </a>
            </li>
            @endif
        </ul>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <form action="
            @if(Route::currentRouteName() == 'detail_variabel')
                {{ route('detail_variabel') }}
            @elseif(Route::currentRouteName() == 'detail_dokumen')
                {{ route('detail_dokumen') }}
            @elseif(Route::currentRouteName() == 'detail_nilai_dokumen')
                {{ route('detail_nilai_dokumen') }}
            @endif
        " method="get">
            <div class="d-flex align-items-center w-sm-45" style="margin-left: 345px; margin-top: 20px; height: 30px;">
                <div class="input-group border-dark">
                    <button class="input-group-button border-dark bg-light btn btn-lgg" type="submit">
                        <i class="fas fa-search fixed-plugin-button-nav cursor-pointer text-dark"></i>
                    </button>
                    <input type="text" class="form-control border-dark bg-light text-white" name="search" placeholder="Search"
                            onfocus="focused(this)" onfocusout="defocused(this)" style="height: 40px;">
                </div>
            </div>
        </form>
        <li class="nav-item px-3 d-flex align-items-center ms-auto mt-3" style="margin-right: -25px;">
            <form action="{{ route('logout') }}" method="POST" class="nav-link text-white p-0">
                @csrf
                <button type="submit" class="btn btn-link btn-lg">
                    <i class="fas fa-power-off fixed-plugin-button-nav cursor-pointer text-white"></i>
                </button>
            </form>
        </li>
            <input type="checkbox" id="check">
                <label for="check">
                    <i class="fas fa-bars" id="btn"></i>
                    <i class="fas fa-times" id="cancel"></i>
                </label>
                <div class="sidebar">
                    <header>SIG</header>
                        <ul>
                            <li><a href="{{ route('show_profile', ['id' => auth()->user()->id]) }}"><i class="fas fa-user"></i>Profil</a></li>
                            <li><a href="#" id="syncLink"><i class="fas fa-repeat"></i>Sync</a></li>
                            <li><a href="{{ route('detail_perusahaan') }}"><i class="far fa-question-circle"></i>Tentang</a></li>
                            <li><a href="{{ route('kontak') }}"><i class="far fa-envelope"></i>Kontak</a></li>
                        </ul>
                </div>
                <!-- <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                            class="fixed-plugin-button-nav cursor-pointer" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="cursor-pointers">
                            <path fill-rule="evenodd"
                                d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 "
                                            alt="user image">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New message</span> from Laur
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/small-logos/logo-spotify.svg"
                                            class="avatar avatar-sm bg-gradient-dark  me-3 " alt="logo spotify">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New album</span> by Travis Scott
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            1 day
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>credit-card</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(453.000000, 454.000000)">
                                                            <path class="color-background"
                                                                d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                opacity="0.593633743"></path>
                                                            <path class="color-background"
                                                                d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            Payment successfully completed
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            2 days
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="nav-item d-flex align-items-center ps-2">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <div class="avatar avatar-sm position-relative">
                        <img src="../assets/img/small-logos/settings2.png" alt="profile_image" class="w-100 border-radius-md">
                    </div>
                </li> -->
                </a>
                </li>
            </ul>
        </div>
    </div>
    <hr class="horizontal w-100 my-0 dark">
    </div>
</nav>

<script>
    // Ambil elemen link dengan ID syncLink
    var syncLink = document.getElementById('syncLink');

    // Tambahkan event listener untuk klik pada link
    syncLink.addEventListener('click', function(event) {
        // Berhenti default behavior dari link (tidak mengarahkan ke halaman baru)
        event.preventDefault();

        // Merefresh halaman
        location.reload();
    });
</script>