<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
            <div class="container my-3 py-3">
            <h3 class="font-weight-bold mb-0">Data Pengguna</h3>
                <hr class="horizontal mb-3 dark">
                <!-- Nav pills -->
                <nav class="nav nav-pills">
                    <li class="nav-item">
                        <a href="#home" class="nav-item nav-link active" data-bs-toggle="pill">
                            <i class="fas fa-users"></i> Karyawan
                        </a>
                    <li>
                    <li class="nav-item">
                        <a href="#profile" class="nav-item nav-link" data-bs-toggle="pill">
                            <i class="fas fa-user"></i> Admin
                        </a>
                    <li>
                </nav>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <div class="col-md-12 mb-6">
                            <div class="card shadow-xs border mb-4">
                                <div class="table-responsive p-0 mt-4">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                                <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nama Lengkap</th>
                                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Username</th>
                                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Alamat Rumah</th>
                                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Email</th>
                                                <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nomer Rekening</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @php
                                                $index = 0
                                                @endphp
                                                @foreach($user as $us)
                                                @if($us->level == 'Karyawan')
                                                <tr>
                                                    <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $index + 1 }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-2 text-center">{{ $us->name }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-1 text-center">{{ $us->username }}</th>
                                                    <th class="font-weight-normal text-sm text-dark ps-1 text-center">{{ $us->alamat_rumah }}</th>
                                                    <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $us->email }}</th>
                                                    <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $us->no_rekening }}</th>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @if($user->isEmpty())
                                                    <td colspan="10" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="mt-2 me-3 justify-content-end d-flex">
                                {{ $user->links() }}
                            </div>
                            <div class="me-3 justify-content-end d-flex">
                                Showing
                                {{ $user->firstItem() }}
                                to
                                {{ $user->lastItem() }}
                                of
                                {{ $user->total() }}
                                entries
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="profile" class="container tab-pane fade"><br>
                <div class="col-md-12 mb-6">
                    <div class="card shadow-xs border mb-4">
                        <div class="table-responsive p-0 mt-4">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                        <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nama Lengkap</th>
                                        <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Username</th>
                                        <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Alamat Rumah</th>
                                        <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Email</th>
                                        <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nomer Rekening</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php
                                        $index = 0
                                        @endphp
                                        @foreach($userA as $usA)
                                        @if($usA->level == 'Admin')
                                        <tr>
                                            <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $index + 1}}</th>
                                            <th class="font-weight-normal text-sm text-dark ps-2 text-center">{{ $usA->name }}</th>
                                            <th class="font-weight-normal text-sm text-dark ps-1 text-center">{{ $usA->username }}</th>
                                            <th class="font-weight-normal text-sm text-dark ps-1 text-center">{{ $usA->alamat_rumah }}</th>
                                            <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $usA->email }}</th>
                                            <th class="font-weight-normal text-sm text-dark pe-4 text-center">{{ $usA->no_rekening }}</th>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @if($userA->isEmpty())
                                            <td colspan="10" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-2 me-3 justify-content-end d-flex">
                                {{ $userA->links() }}
                            </div>
                            <div class="me-3 justify-content-end d-flex">
                                Showing
                                {{ $userA->firstItem() }}
                                to
                                {{ $userA->lastItem() }}
                                of
                                {{ $userA->total() }}
                                entries
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>