<?php
include '../connection.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordKonfirmasi = $_POST['passwordKonfirmasi'];
    $role = $_POST['role'];
    $passHash = password_hash($password, PASSWORD_DEFAULT);

    // validasi username yang sama
    $result = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
    $rowCount = mysqli_num_rows($result);

    if (mysqli_num_rows($result) > 0) {
        sweetAlert("error", "Username tidak dapat digunakan", "?page=userAdd");
    } else {
        if ($password === $passwordKonfirmasi) {
            $error = 0;
            $insert = mysqli_query($con, "INSERT INTO users (username, password, role) VALUES('$username','$passHash','$role')");
            if ($insert) {
                sweetAlert("success", "Data berhasil disimpan", "?page=user");
            }
        } else {
            $error = 1;
        }
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
                        <label for="role" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select name="role" class="form-control">
                                <option value="-">-- Pilih Role User --</option>
                                <option value="admin">Admin</option>
                                <option value="user_desa">User Desa</option>
                                <option value="pimpinan">Pimpinan</option>
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
                    sweetAlert("error", "Data gagal disimpan", "?page=user");
                }
                ?>
            </div>
        </div>
    </div>
</div>