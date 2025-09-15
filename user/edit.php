<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM users WHERE user_id=$id");
list(, $username, $password, $role) = mysqli_fetch_array($result);
$success = 2; // state awal

if (isset($_POST['submitLevel'])) {
  $role = $_POST['role'];
  $update = mysqli_query($con, "UPDATE users SET role='$role' WHERE user_id=$id");
  if ($update) {
    $success = 1;
  } else {
    $success = 0;
  }
}

if (isset($_POST['submitUsername'])) {
  $username = $_POST['username'];
  // validasi username yang sama
  $result = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
  $rowCount = mysqli_num_rows($result);

  if (mysqli_num_rows($result) > 0) {
    $success = 0;
  } else {
    $update = mysqli_query($con, "UPDATE users SET username='$username' WHERE user_id=$id");
    if ($update) {
      $success = 1;
    }
  }
}

if (isset($_POST['submitPassword'])) {
  $passwordLama = $_POST['passwordLama'];
  $passwordBaru = password_hash($_POST['passwordBaru'], PASSWORD_DEFAULT);
  $passwordHash = $data['password'];

  if (password_verify($passwordLama, $password)) {
    $update = mysqli_query($con, "UPDATE users SET password='$passwordBaru' WHERE user_id=$id");
    if ($update) {
      $success = 1;
    }
  } else {
    $success = 0;
  }
}


?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col-md-10">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">User</h6>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="row mb-3">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <select name="role" id="role" class="form-control" name="role" required>
                <option value="-" disabled>- Pilih -</option>
                <option value="admin" <?php echo ($role == 'admin') ? "selected" : ""; ?>>Admin
                </option>
                <option value="user_desa" <?php echo ($role == 'user_desa') ? "selected" : ""; ?>>User Desa</option>
                <option value="pimpinan" <?php echo ($role == 'pimpinan') ? "selected" : ""; ?>>Pimpinan</option>
              </select>
            </div>
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-sm btn-primary mt-2" name="submitLevel"><i class="fas fa-save"></i>
                Simpan</button>
            </div>
          </div>
        </form>
        <hr>
        <form method="post">
          <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input name="username" type="text" class="form-control" id="username" value="<?= $username; ?>" required>
            </div>
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-sm btn-primary mt-2" name="submitUsername"><i
                  class="fas fa-save"></i>
                Simpan</button>
            </div>
          </div>
          <hr>
        </form>

        <form method="post">
          <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">Password Lama</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="passwordLama" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="passwordBaru" required>
            </div>
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-sm btn-primary mt-2" name="submitPassword"><i
                  class="fas fa-save"></i>
                Simpan</button>
            </div>
          </div>
        </form>
        <hr>
        <div class="row">
          <div class="col offset-sm-2">
            <a href="?page=user" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
              Kembali</a>
          </div>
        </div>
        <?php
        if ($success == 1) {
          sweetAlert("success", "Data berhasil diubah", "?page=user");
        } else if ($success == 0) {
          sweetAlert("error", "Data gagal diubah", "?page=user");
        }
        ?>
      </div>
    </div>
  </div>
</div>