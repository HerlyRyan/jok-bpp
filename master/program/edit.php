<?php
// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data yang akan diedit
$query = mysqli_query($con, "SELECT * FROM program WHERE program_id = '$id'");
$data = mysqli_fetch_assoc($query);


if (isset($_POST['submit'])) {
    $program_id = $_POST['program_id'];
    $nama_program = $_POST['nama_program'];
    $deskripsi = $_POST['deskripsi'];

    $result = mysqli_query($con, "UPDATE program SET nama_program='$nama_program', deskripsi='$deskripsi' WHERE program_id = '$program_id'");

    if ($result) {
        sweetAlert("success", "Data berhasil diubah", "?page=master");
    } else {
        sweetAlert("error", "Data gagal diubah", "?page=master");
    }
}
?>

<div class="row">
    <div class="col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <!-- Hidden input for ID -->
                    <input type="hidden" name="program_id" value="<?php echo $data['program_id']; ?>">

                    <div class="mb-3 row">
                        <label for="nama_program" class="col-sm-2 col-form-label">Nama Program</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_program" placeholder="Masukan Nama Bidang..." required value="<?php echo $data['nama_program']; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="deskripsi" placeholder="Masukan Deskripsi Program..." required><?php echo $data['deskripsi']; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col offset-md-2">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                            <a href="?page=master" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>