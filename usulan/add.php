<?php
if (isset($_POST['submit'])) {
    $user_id    = $_POST['user_id'];
    $bidang_id  = $_POST['bidang_id'];
    $satuan_id  = $_POST['satuan_id'];
    $program_id = $_POST['program_id'];
    $judul      = $_POST['judul'];
    $lokasi     = $_POST['lokasi'];
    $usulan     = $_POST['usulan'];
    $volume     = $_POST['volume'];

    // ambil tanggal & tahun sekarang
    $tanggal = date('Y-m-d'); // format DATE
    $tahun   = date('Y');     // format YEAR

    $status_penetapan = "Masuk";

    $result = mysqli_query($con, "
        INSERT INTO usulan(user_id, bidang_id, satuan_id, program_id, judul, lokasi, usulan, volume, tanggal, tahun, status_penetapan) 
        VALUES('$user_id','$bidang_id','$satuan_id','$program_id', '$judul', '$lokasi', '$usulan','$volume','$tanggal','$tahun', '$status_penetapan')
    ");

    if ($result) {
        sweetAlert("success", "Data berhasil disimpan", "?page=dashboard");
    } else {
        sweetAlert("error", "Data gagal disimpan", "?page=dashboard");
    }
}

?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="bidang_id" class="col-sm-2 col-form-label">Bidang</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="bidang_id" required>
                                    <option value="">-- Pilih Bidang --</option>
                                    <?php
                                    // Contoh query untuk mengambil data bidang
                                    $queryBidang = mysqli_query($con, "SELECT * FROM bidang");
                                    while ($data = mysqli_fetch_array($queryBidang)) {
                                        echo '<option value="' . $data['bidang_id'] . '">' . $data['nama_bidang'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="program_id" class="col-sm-2 col-form-label">Program</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="program_id" required>
                                    <option value="">-- Pilih Program --</option>
                                    <?php
                                    // Contoh query untuk mengambil data program
                                    $queryProgram = mysqli_query($con, "SELECT * FROM program");
                                    while ($data = mysqli_fetch_array($queryProgram)) {
                                        echo '<option value="' . $data['program_id'] . '">' . $data['nama_program'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="judul" class="col-sm-4 col-form-label">Nama Kegiatan</label>
                            <div class="col-sm-12">
                                <input class="form-control" name="judul" placeholder="Masukan Nama Kegiatan..." required></input>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="lokasi" class="col-sm-4 col-form-label">Lokasi</label>
                            <div class="col-sm-12">
                                <input class="form-control" name="lokasi" placeholder="Masukan Lokasi..." required></input>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="usulan" class="col-sm-4 col-form-label">Usulan</label>
                            <div class="col-sm-12">
                                <input class="form-control" name="usulan" placeholder="Masukan Usulan" required></input>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="volume" class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="volume" placeholder="Masukan Volume..." required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="program_id" class="col-sm-4 col-form-label">Satuan</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="satuan_id" required>
                                    <option value="">-- Pilih Satuan --</option>
                                    <?php
                                    // Contoh query untuk mengambil data satuan
                                    $querySatuan = mysqli_query($con, "SELECT * FROM satuan");
                                    while ($data = mysqli_fetch_array($querySatuan)) {
                                        echo '<option value="' . $data['satuan_id'] . '">' . $data['nama_satuan'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col offset-md-0">
                            <div class="col-sm-12">
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim Usulan</button>
                                <a href="?page=dashboard" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>