<?php
if (isset($_POST['submit'])) {
    $nama_program = $_POST['nama_program'];
    $deskripsi = $_POST['deskripsi'];

    $result = mysqli_query($con, "INSERT INTO program (nama_program, deskripsi) VALUES('$nama_program', '$deskripsi')");
    if ($result) {
        sweetAlert("success", "Data berhasil disimpan", "?page=master");
    } else {
        sweetAlert("error", "Data gagal disimpan", "?page=master");
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
                    <div class="mb-3 row">
                        <label for="nama_program" class="col-sm-2 col-form-label">Nama Program</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_program" placeholder="Masukan Nama program..." required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="deskripsi" placeholder="Masukan Deskripsi Program..." required></textarea>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col offset-md-2">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="?page=master" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>