<?php
include '../connection.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordKonfirmasi = $_POST['passwordKonfirmasi'];
    $level = $_POST['level'];
    $passHash = password_hash($password, PASSWORD_DEFAULT);

    // validasi username yang sama
    $result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
    $rowCount = mysqli_num_rows($result);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>window.alert('username tidak dapat digunakan');</script>";
        echo "<script>window.location.href = '?page=userAdd';</script>";
        exit;
    }

    if ($password === $passwordKonfirmasi) {
        $error = 0;
        $insert = mysqli_query($con, "INSERT INTO user(username,password,level) VALUES('$username','$passHash','$level')");
        echo "<script>window.location.href = '?page=user';</script>";
    } else {
        $error = 1;
    }
}

?>
<div class="row">

    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title ?></h6>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" placeholder="masukan username...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
                            <select name="level" class="form-control">
                                <option value="-">- pilih level user -</option>
                                <option value="0">Admin</option>
                                <option value="1">Divisi</option>
                                <option value="2">Supervisor</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="masukan password...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="konfirmasiPassword" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="passwordKonfirmasi" placeholder="masukan konfirmasi password...">
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col offset-md-3">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="?page=user" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>

                <?php
                if ($error == 1) {
                    echo '
                        <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
                            Periksa kembali password!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ';
                }
                ?>
            </div>
        </div>
    </div>
</div>