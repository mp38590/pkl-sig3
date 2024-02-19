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
                                                    <h4 class="text-dark font-weight-bolder">#1</h4>
                                                    <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">PT Semen Padang (Persero) Tbk.
                                                    </p>
                                                    <h5 class="text-dark font-weight-bolder">Indarung, Sumatera Barat</h5>
                                                </div>
                                                <div class="col-sm-3 ms-auto mt-auto">
                                                    <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">
                                                        Lima Pabrik Semen</p>
                                                    <h5 class="text-dark font-weight-bolder">8,5 Juta Ton Semen per Tahun</h5>
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
                                                <h4 class="text-dark font-weight-bolder">#2</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">PT Semen Gresik (Persero) Tbk.</p>
                                                <h5 class="text-dark font-weight-bolder">Rembang, Jawa Tengah</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Lima Pabrik Semen
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">17,7 Juta Ton Semen per Tahun</h5>
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
                                                <h4 class="text-dark font-weight-bolder">#3</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">PT Semen Tonasa (Persero) Tbk.</p>
                                                <h5 class="text-dark font-weight-bolder">Pangkep, Sulawesi Selatan</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Empat Pabrik Semen
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">7,4 Juta Ton per Tahun</h5>
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
                                                <h4 class="text-dark font-weight-bolder">#4</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">PT Semen Baturaja (Persero) Tbk.</p>
                                                <h5 class="text-dark font-weight-bolder">Baturaja, Sumatera Selatan</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Satu Pabrik Semen
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">1,25 Juta Ton per Tahun</h5>
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
                                                <h4 class="text-dark font-weight-bolder">#5</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">PT Solusi Bangun Indonesia (Persero) Tbk.</p>
                                                <h5 class="text-dark font-weight-bolder">Sidoarjo, Jawa Timur</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Enam Pabrik Semen
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">14,8 Juta Ton per Tahun</h5>
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
                                                <h4 class="text-dark font-weight-bolder">#6</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Thang Long Cement Join Stock Company (TLCC)</p>
                                                <h5 class="text-dark font-weight-bolder">Quang Ninh, Vietnam</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Satu Pabrik Semen
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">2,3 Juta Ton per Tahun</h5>
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
                                                <h4 class="text-dark font-weight-bolder">#7</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">PT Semen Indonesia Aceh (Persero) Tbk.</p>
                                                <h5 class="text-dark font-weight-bolder">Kecamatan Batee dan Muara Tiga, Kabupaten Pidie, Aceh</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Satu Pabrik Semen
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">3 Juta Ton per Tahun</h5>
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
                <div class="col-xl-6 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                                    <path fill-rule="evenodd"
                                        d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-xl text-secondary mb-1">Jumlah Dokumen Terupload</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $jumlah_dokumen }} Dokumen</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>{{ $presentase }} %
                                            </span>
                                            <span class="text-xl ms-1">dari {{ $jumlah_dokumen }} Dokumen</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-xl-6 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-xl text-secondary mb-1">Rata-Rata Skor dari Dokumen Terupload</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $rata_skor }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-xl ms-1">Berdasarkan perubahan terakhir <span class="text-info">{{ $latestTimestamp }}</span></span>
                                        </div>
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
                                        <h1 style="font-size: 25px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="font-weight-bolder">Karyawan</h1>
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
                            <a href="{{ route('detail_file_dokumen') }}" type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-right justify-content-end mb-0 ms-5">
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
                        <div class="card-header font-weight-semibold d-flex justify-content-between align-items-center">Grafik Rata-Rata Nilai Dokumen Terupload
                            <a href="{{ route('detail_dokumen') }}" type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-right justify-content-end mb-0 ms-5">
                                <span class="btn-inner--text">Detail Dokumen</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div id="Grafik2">
                                <canvas id="realisasiChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row pe-0">
                <div class="col-6 mt-3 pe-2">
                    <div class="card shadow-xs border">
                        <div class="card-header font-weight-semibold">Grafik Banyak Dokumen Terupload Setiap ID</div>
                        <div class="card-body">
                            <div id="Grafik1">
                                <canvas id="banyakChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-3 pe-0"> -->
                    <div class="card shadow-xs border">
                        <div class="card-header font-weight-semibold">Grafik Nilai Dokumen Terupload Setiap Bulan</div>
                        <div class="card-body">
                            <div id="Grafik2">
                                <canvas id="nilaiChart" width="400" height="200"></canvas>
                            </div>
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
    var ctx = document.getElementById('realisasiChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($label),
            datasets: [{
                label: 'Rata-rata Nilai',
                data: @json($average),
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

<!-- <script>
    var ctx = document.getElementById('banyakChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($x),
            datasets: [{
                label: 'Banyak Dokumen per ID',
                data: @json($y),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        callback: function(value, index, values) {
                            var startIndex = 0; // Nilai default jika data tidak ditemukan
                            @if($banyak->isNotEmpty())
                                startIndex = @json($banyak->first()->id);
                            @endif // Mengambil id pertama dari data
                            return (startIndex + index) + ' - ' + @json($z)[index];
                        }
                    }
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        title: function(tooltipItem) {
                            return 'ID: ' + tooltipItem[0].label;
                        }
                    }
                }
            },
            onClick: function(evt, element) {
                if (element.length > 0) {
                    var index = element[0].index;
                    var id = @json($x)[index]; // Mengambil ID dari data yang diklik
                    window.location.href = "{{ route('show_dokumen', ['id' => ':id']) }}".replace(':id', id);
                }
            }
        }
    });
</script> -->

<script>
    var ctx = document.getElementById('nilaiChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($m),
            datasets: [{
                label: 'Nilai Dokumen Setiap Bulan',
                data: @json($l),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true // Mulai dari 0
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
                    var kode_penilaian = @json($m)[index]; // Mengambil kode penilaian dari data yang diklik
                    window.location.href = "/detail-nilai-dokumen?kode=" + kode_penilaian;
                }
            }
        }
    });
</script>


<script>
function syncData() {
    // Menggunakan Fetch API untuk mengirim permintaan ke server
    fetch('{{ route('sync') }}', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        // Menanggapi respons dari server
        if (data.status === 'success') {
            // Merefresh halaman
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
