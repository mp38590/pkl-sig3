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
            <!-- <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('verifikasi_dokumen') }}" class="nav-link text-white p-0 text-lg">
                    Verifikasi Dokumen
                </a>
            </li> -->
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('detail_dokumen_admin') }}" class="nav-link text-white p-0 text-lg">
                    Detail Dokumen
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('data_pengguna') }}" class="nav-link text-white p-0 text-lg">
                    Data Pengguna
                </a>
            </li>
            @endif
        </ul>
        @if (auth()->user()->level=="Karyawan")
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
                        <i class="fas fa-bars fixed-plugin-button-nav cursor-pointer text-white" id="btn"></i>
                        <i class="fas fa-times fixed-plugin-button-nav cursor-pointer text-white" id="cancel"></i>
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
                    </a>
                    </li>
                </ul>
            </div>
        @elseif (auth()->user()->level=="Admin")
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <form action="
                @if(Route::currentRouteName() == 'verifikasi_dokumen')
                    {{ route('verifikasi_dokumen') }}
                @elseif(Route::currentRouteName() == 'data_pengguna')
                    {{ route('data_pengguna') }}
                @elseif(Route::currentRouteName() == 'detail_dokumen_admin')
                    {{ route('detail_dokumen_admin') }}
                @endif
            " method="get">
                <div class="d-flex align-items-center w-sm-45" style="margin-left: 387px; margin-top: 20px; height: 30px;">
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
                                <li><a href="{{ route('show_profile_admin', ['id' => auth()->user()->id]) }}"><i class="fas fa-user"></i>Profil</a></li>
                                <li><a href="#" id="syncLink"><i class="fas fa-repeat"></i>Sync</a></li>
                                <li><a href="{{ route('detail_perusahaan') }}"><i class="far fa-question-circle"></i>Tentang</a></li>
                                <li><a href="{{ route('kontak') }}"><i class="far fa-envelope"></i>Kontak</a></li>
                            </ul>
                    </div>
                    </a>
                    </li>
                </ul>
            </div>
        @endif
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

<style>
@import url('https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500');
* {
    padding: 0;
    margin: 0;
    list-style: none;
    text-decoration: none;
}

body {
    font-family: 'Roboto', sans-serif;
}

.sidebar {
    position: fixed;
    right: -250px;
    top: 0px;
    width: 250px;
    height: 790px;
    background: #042331;
    transition: all .5s ease;
}

.sidebar header {
    font-size: 22px;
    color: white;
    line-height: 70px;
    text-align: center;
    background: #063146;
    user-select: none;
}

.sidebar ul a {
    display: block;
    height: 100%;
    width: 100%;
    line-height: 65px;
    font-size: 20px;
    color: white;
    padding-left: 5px;
    box-sizing: border-box;
    border-bottom: 1px solid black;
    border-top: 1px solid rgba(255, 255, 255, .1);
    transition: .4s;
}

ul li:hover a {
    padding-left: 50px;
}

.sidebar ul a i {
    margin-right: 16px;
}

#check {
    display: none;
}

label #btn,
label #cancel {
    position: fixed;
    border-radius: 3px;
    cursor: pointer;
    z-index: 10000; /* Ensure the cancel button is on top */
}

/* Updated CSS for the button */
label #btn {
    align-items: end;
    justify-content: flex-end;
    position: fixed;
    right: 25px;
    top: 25px;
    font-size: 35px;
    color: white;
    padding: 6px 12px;
    transition: all .5s;
}

label #cancel {
    right: -40px;
    top: 5px;
    font-size: 30px;
    color: #0a5275;
    padding: 4px 9px;
    transition: all .5s ease;
}

#check:checked~.sidebar {
    right: 0;
    z-index: 9999;
}

#check:checked~label #btn {
    opacity: 0;
    pointer-events: none;
}

#check:checked~label #cancel {
    right: 5px;
}

#check:checked~section {
    margin-left: 250px;
}

section {
    background: url(bg.jpeg) no-repeat;
    background-position: center;
    background-size: cover;
    height: 100vh;
    transition: margin-right .5s;
    margin-right: 0;
    position: fixed;
}
</style>