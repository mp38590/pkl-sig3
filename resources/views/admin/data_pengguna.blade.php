<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<main class="main-content max-height-vh-100 h-100">
    <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
    <div class="container my-3 py-3">
        <div class="container mt-3">
        <!-- Nav pills -->
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="pill" href="#home">Karyawan</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#profile">Admin</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>
            <div class="col-md-12 mb-6">
            <div class="card shadow-xs border mb-4">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <!-- <span class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                    <!-- <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                    </div> -->
                                    <th class="text-info text-s font-weight-semibold ps-3">No.</th>
                                    <th class="text-info text-s font-weight-semibold ps-1">Nama Lengkap</th>
                                    <th class="text-info text-s font-weight-semibold ps-1">Username</th>
                                    <th class="text-info text-s font-weight-semibold ps-3">Alamat Rumah</th>
                                    <th class="text-info text-s font-weight-semibold ps-4">Email</th>
                                    <th class="text-info text-s font-weight-semibold ps-4">No Rekening</th>
                                <!-- </span> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                    <th class="font-weight-normal text-sm text-dark ps-3">1.</th>
                                    <th class="font-weight-normal text-sm text-dark ps-1">Subardi Wirawan Putra</th>
                                    <th class="font-weight-normal text-sm text-dark ps-1">KHidenife</th>
                                    <th class="font-weight-normal text-sm text-dark ps-3">KHidenifedewf</th>
                                    <th class="font-weight-normal text-sm text-dark ps-4">KHidenifedew</th>
                                    <th class="font-weight-normal text-sm text-dark ps-4">KHidenifedewf</th>
                                <!-- </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            </div>
            <div id="profile" class="container tab-pane fade"><br>
            <div class="col-md-12 mb-6">
            <div class="card shadow-xs border mb-4">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <!-- <span class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                    <!-- <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                    </div> -->
                                    <th class="text-info text-s font-weight-semibold ps-3">No.</th>
                                    <th class="text-info text-s font-weight-semibold ps-1">Nama Lengkap</th>
                                    <th class="text-info text-s font-weight-semibold ps-1">Username</th>
                                    <th class="text-info text-s font-weight-semibold ps-3">Alamat Rumah</th>
                                    <th class="text-info text-s font-weight-semibold ps-4">Email</th>
                                    <th class="text-info text-s font-weight-semibold ps-4">No Rekening</th>
                                <!-- </span> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                    <th class="font-weight-normal text-sm text-dark ps-3">1.</th>
                                    <th class="font-weight-normal text-sm text-dark ps-1">Subardi Wirawan Putra</th>
                                    <th class="font-weight-normal text-sm text-dark ps-1">KHidenife</th>
                                    <th class="font-weight-normal text-sm text-dark ps-3">KHidenifedewf</th>
                                    <th class="font-weight-normal text-sm text-dark ps-4">KHidenifedew</th>
                                    <th class="font-weight-normal text-sm text-dark ps-4">KHidenifedewf</th>
                                <!-- </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            </div>
        </div>
        </div>
</body>
</html>
    </main>
</body>

</x-app-layout>