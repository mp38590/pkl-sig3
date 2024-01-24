<x-app-layout>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <hr class="horizontal mb-3 dark">
            <div class="row">
                <div class="col-md-12 mb-6">
                    <div class="card shadow-s border mb-4">
                    <form role="form" method="POST" action="{{ route('konfirm_hapus_dokumen') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="tahun" class="form-control-label">Tahun</label>
                                <input name="tahun" class="form-control" type="text" id="tahun" value="{{ $realisasi->tahun }}">
                        </div>
                        <div class="form-group">
                            <label for="versi" class="form-control-label">Versi</label>
                                <input name="versi" class="form-control" type="text" id="versi" value="{{ $variabelPenilaian->versi }}">
                        </div>
                        <div class="form-group">
                            <label for="nilai_maksimal" class="form-control-label">Skor Maksimal</label>
                                <input name="nilai_maksimal" class="form-control" type="text" id="nilai_maksimal" value="{{ $variabelPenilaian->nilai_maksimal }}">
                        </div>
                        <div class="form-group">
                            <label for="nilai" class="form-control-label">Skor Final</label>
                                <input name="nilai" class="form-control" type="text" id="nilai" value="{{ $realisasi->nilai }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_dokumen" class="form-control-label">Nama Dokumen</label>
                            <select name="nama_dokumen" class="form-control">
                                <option value="">-- Pilih Nama File Dokumen -- </option>
                                <?php
                                // Assuming you have a PostgreSQL connection established
                                $host = '127.0.0.1';
                                $dbname = 'pkl';
                                $user = 'postgres';
                                $password = 'Mutiara123_';

                                $db = pg_connect("host=$host dbname=$dbname user=$user password=$password");

                                if (!$db) {
                                    die("Error in connection: " . pg_last_error());
                                }

                                $query = "SELECT * FROM dokumen ORDER BY nama_dokumen";
                                $result = pg_query($db, $query);

                                if (!$result) {
                                    die("Error in SQL query: " . pg_last_error());
                                }

                                while ($data = pg_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $data['id'] ?>"><?php echo $data['nama_dokumen'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button href=/detail-dokumen type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>