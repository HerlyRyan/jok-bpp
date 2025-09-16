<?php
if (isset($_POST['submit'])) {
    $user_id        = $_POST['user_id'];
    $judul          = $_POST['judul'];
    $isi_pengaduan  = $_POST['isi_pengaduan'];
    $status         = 'Masuk';
    $tanggapan      = 'Belum ada tanggapan';

    // ambil tanggal sekarang
    $tanggal = date('Y-m-d'); // format DATE

    $result = mysqli_query($con, "
        INSERT INTO pengaduan(user_id, judul, isi_pengaduan, status, tanggapan, tanggal_pengaduan) 
        VALUES('$user_id', '$judul', '$isi_pengaduan', '$status', '$tanggapan', '$tanggal')
    ");

    if ($result) {
        sweetAlert("success", "Data berhasil disimpan", "?page=pengaduanAdd");
    } else {
        sweetAlert("error", "Data gagal disimpan", "?page=pengaduanAdd");
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
                            <label for="judul" class="col-sm-4 col-form-label">Judul Pengaduan</label>
                            <div class="col-sm-12">
                                <input class="form-control" name="judul" placeholder="Masukan Judul Pengaduan..." required></input>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="isi_pengaduan" class="col-sm-4 col-form-label">Isi Pengaduan</label>
                            <div class="col-sm-12">
                                <input class="form-control" name="isi_pengaduan" placeholder="Masukan Isi Pengaduan..." required></input>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col offset-md-0">
                            <div class="col-sm-12">
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim Pengaduan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>