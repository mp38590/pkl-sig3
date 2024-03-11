<x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3 mt-5">
                            <h3 class="font-weight-bold mb-0">Hello, {{ $user->name }}</h3>
                            <p class="mb-0">Halaman Ini Merupakan Halaman Terkait Informasi Penting PT Semen Indonesia (Persero) Tbk. </br>
                                            Secara Singkat dan Aktivitas Anda dalam Penggunaan Website SimL.</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="row">
                <div class="position-relative overflow-hidden">
                    <div class="swiper mySwiper mt-4 mb-2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div>
                                    <div
                                        class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                        <div class="full-background bg-cover"
                                            style="background-image: url('../assets/img/pabrik/pabrik-padang.jpg')"></div>
                                        <div class="card-body text-start px-3 py-0 w-100">
                                            <div class="row mt-12">
                                                <div class="col-sm-3 mt-auto">
                                                    <h4 class="text-white font-weight-bolder">#1</h4>
                                                    <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">PT Semen Padang (Persero) Tbk.
                                                    </p>
                                                    <h5 class="text-white font-weight-bolder">Indarung, Sumatera Barat</h5>
                                                </div>
                                                <div class="col-sm-3 ms-auto mt-auto">
                                                    <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">
                                                        Lima Pabrik Semen</p>
                                                    <h5 class="text-white font-weight-bolder">8,5 Juta Ton Semen per Tahun</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/pabrik/pabrik-gresik.jpeg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-white font-weight-bolder">#2</h4>
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">PT Semen Gresik (Persero) Tbk.</p>
                                                <h5 class="text-white font-weight-bolder">Rembang, Jawa Tengah</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">Lima Pabrik Semen
                                                </p>
                                                <h5 class="text-white font-weight-bolder">17,7 Juta Ton Semen per Tahun</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/pabrik/pabrik-tonasa.jpeg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-white font-weight-bolder">#3</h4>
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">PT Semen Tonasa (Persero) Tbk.</p>
                                                <h5 class="text-white font-weight-bolder">Pangkep, Sulawesi Selatan</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">Empat Pabrik Semen
                                                </p>
                                                <h5 class="text-white font-weight-bolder">7,4 Juta Ton per Tahun</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/pabrik/pabrik-baturaja.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-white font-weight-bolder">#4</h4>
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">PT Semen Baturaja (Persero) Tbk.</p>
                                                <h5 class="text-white font-weight-bolder">Baturaja, Sumatera Selatan</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">Satu Pabrik Semen
                                                </p>
                                                <h5 class="text-white font-weight-bolder">1,25 Juta Ton per Tahun</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/pabrik/pabrik-sbi.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-white font-weight-bolder">#5</h4>
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">PT Solusi Bangun Indonesia (Persero) Tbk.</p>
                                                <h5 class="text-white font-weight-bolder">Sidoarjo, Jawa Timur</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">Enam Pabrik Semen
                                                </p>
                                                <h5 class="text-white font-weight-bolder">14,8 Juta Ton per Tahun</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/pabrik/pabrik-thang.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-white font-weight-bolder">#6</h4>
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">Thang Long Cement Join Stock Company (TLCC)</p>
                                                <h5 class="text-white font-weight-bolder">Quang Ninh, Vietnam</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">Satu Pabrik Semen
                                                </p>
                                                <h5 class="text-white font-weight-bolder">2,3 Juta Ton per Tahun</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/pabrik/pabrik-aceh.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-white font-weight-bolder">#7</h4>
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">PT Semen Indonesia Aceh (Persero) Tbk.</p>
                                                <h5 class="text-white font-weight-bolder">Kecamatan Batee dan Muara Tiga, Kabupaten Pidie, Aceh</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-white opacity-6 text-xs font-weight-bolder mb-0">Satu Pabrik Semen
                                                </p>
                                                <h5 class="text-white font-weight-bolder">3 Juta Ton per Tahun</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-sm position-relative mt-1 mb-3 border-radius-sm" style="width: 30px; height: 30px; background: #000; border: #000;">
                                <img src="../assets/img/small-logos/file.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-xl text-secondary mb-1">Jumlah Dokumen Terupload</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $tambah_dokumen }} Dokumen</h4>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>{{ $presentase }} %
                                            </span>
                                            <span class="text-xl ms-1">dari {{ $jumlah_dokumen }} Dokumen</span>
                                        </div>
                                    </div></br></br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-sm position-relative mt-1 mb-3 border-radius-sm" style="width: 30px; height: 30px; background: #000; border: #000;">
                                <img src="../assets/img/small-logos/notApprove.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-xl text-secondary mb-1">Jumlah Dokumen Belum Terverifikasi</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $verifikasi }} Dokumen</h4>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>{{ $presentaseVerifikasi }} %
                                            </span>
                                            <span class="text-xl ms-1">dari {{ $jumlah_verifikasi }} Dokumen</span>
                                        </div>
                                    </div></br></br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-sm position-relative mt-1 mb-3 border-radius-sm" style="width: 30px; height: 30px; background: #000; border: #000;">
                                <img src="../assets/img/small-logos/notApprove.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 20px; height: 20px;">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-xl text-secondary mb-1">Jumlah Pengguna Terdaftar</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $tambah_pengguna }} Pengguna</h4>
                                        <span class="text-xl ms-1">Jumlah karyawan sebanyak {{ $jumlah_karyawan }} karyawan</span></br>
                                        <span class="text-xl ms-1">Jumlah admin sebanyak {{ $jumlah_admin }} admin</span>
                                        <div class="d-flex align-items-center mt-2">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>{{ $presentasePengguna }} %
                                            </span>
                                            <span class="text-xl ms-1">dari {{ $jumlah_pengguna }} Pengguna</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h4 class="text-lg mb-0">Detail Profile</h4>
                                    <p class="text-s mb-sm-0 mb-2">Silahkan Cek dan Lakukan Perubahan untuk Data Pribadi Anda!</p>
                                </div>
                            </div>
                            <div class="d-sm-flex align-items-top">
                                <div class="circle-icon">
                                    <img src="{{ asset('uploads/profiles/' . $user->foto) }}" alt="karyawan" class="rounded-circle" style="width: 100px; height: 100px">
                                </div>
                            <div class="mb-3">
                                <div style="position: relative; left: 20px">
                                    <div>
                                        <h1 style="font-size: 25px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="font-weight-bolder">{{ $user->level }}</h1>
                                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Nama <span style="margin-left: 20px;">: {{ $user->name }}</p>
                                        <p class="text-muted">
                                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">NIK <span style="margin-left: 38px;">: {{ $user->nik }}</p>
                                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Jabatan <span style="margin-left: 8px;">: {{ $user->jabatan }}</p>
                                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Level <span style="margin-left: 26px;">: {{ $user->level }}</p>
                                        <!-- <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Dokumen Approve: </p>
                                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Dokumen Tidak Approve:</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 mt-3">
                        <div class="card shadow-xs border">
                            <div class="card-header">Grafik Keaktifan User</div>
                            <div class="card-body">
                                <div id="Grafik"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row pe-0">
                <div class="col-6 mt-3 pe-2">
                    <div class="card shadow-xs border">
                        <div class="card-header font-weight-semibold d-flex justify-content-between align-items-center">Grafik Jumlah Dokumen Terupload
                            <a href="{{ route('detail_file_dokumen_admin') }}" type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-right justify-content-end mb-0 ms-5">
                                <span class="btn-inner--text">Detail File Dokumen</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div id="Grafik1">
                                <canvas id="dokumenChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-3 pe-0">
                    <div class="card shadow-xs border">
                        <div class="card-header font-weight-semibold d-flex justify-content-between align-items-center">Grafik Jumlah Dokumen Terapprove
                            <a href="{{ route('detail_file_approve_admin') }}" type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-right justify-content-end mb-0 ms-5">
                                <span class="btn-inner--text">Detail Dokumen</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div id="Grafik2">
                                <canvas id="verifikasiChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-13 mt-3">
                <div class="card shadow-xs border">
                    <div class="card-header font-weight-semibold d-flex justify-content-between align-items-center">Grafik Jumlah Dokumen Terupload
                    </div>
                    <div class="card-body">
                        <div id="Grafik2">
                            <canvas id="nilaiChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>

<script>
    var ctx = document.getElementById('dokumenChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah Dokumen',
                data: @json($values),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
        var ctx = document.getElementById('verifikasiChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($label) !!},
                datasets: [{
                    label: 'Jumlah Dokumen',
                    data: {!! json_encode($value) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

<script>
    var ctx = document.getElementById('nilaiChart').getContext('2d');
var nilaiData = @json($l);
var nilaiLabels = @json($m);

// Fungsi untuk menentukan warna sesuai dengan nilai
function getColor(value) {
    switch (value) {
        case 1:
            return 'rgba(255, 0, 0, 0.2)'; // Merah
        case 2:
            return 'rgba(255, 165, 0, 0.2)'; // Oren
        case 3:
            return 'rgba(255, 255, 0, 0.2)'; // Kuning
        case 4:
            return 'rgba(00, 128, 0, 0.2)'; // Hijau
        case 5:
            return 'rgba(75, 192, 192, 0.2)'; // Biru
    }
}

var datasets = [];
for (var i = 1; i <= 5; i++) {
    var filteredData = nilaiData.map((nilai) => nilai === i ? nilai : null);
    datasets.push({
        label: 'Nilai ' + i, // Nama label sesuai dengan nilai
        data: filteredData,
        backgroundColor: getColor(i), // Warna sesuai dengan nilai
        borderColor: getColor(i).replace("0.2", "1"), // Warna border dengan opasitas penuh
        borderWidth: 1
    });
}

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: nilaiLabels,
        datasets: datasets
    },
    options: {
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    title: function(tooltipItem) {
                        return 'Kode Penilaian: ' + tooltipItem[0].label;
                    }
                }
            }
        },
        onClick: function(evt, element) {
            if (element.length > 0) {
                var index = element[0].index;
                var kode_penilaian = nilaiLabels[index]; // Mengambil kode penilaian dari data yang diklik
                window.location.href = "/detail-nilai-dokumen-admin?kode=" + kode_penilaian;
            }
        }
    }
});

</script>
