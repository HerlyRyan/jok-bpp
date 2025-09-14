<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM user WHERE id=$id");
list(, $username, $password, $level) = mysqli_fetch_array($result);


if (isset($_POST['submitLevel'])) {
  $level = $_POST['level'];
  mysqli_query($con, "UPDATE user SET level='$level' WHERE id=$id");
  echo "<script>window.location.href = '?page=user';</script>";
}

if (isset($_POST['submitUsername'])) {
  $username = $_POST['username'];
  mysqli_query($con, "UPDATE user SET username='$username' WHERE id=$id");
  echo "<script>window.location.href = '?page=user';</script>";
}

if (isset($_POST['submitPassword'])) {
  $passwordLama = $_POST['passwordLama'];
  $passwordBaru = password_hash($_POST['passwordBaru'], PASSWORD_DEFAULT);
  $passwordHash = $data['password'];

  if (password_verify($passwordLama, $password)) {
    mysqli_query($con, "UPDATE user SET password='$passwordBaru' WHERE id=$id");
    echo "<script>alert('Password berhasil diganti')</script>";
    echo "<script>window.location.href = '?page=user-show';</script>";
  } else {
    echo "<script>alert('Password lama tidak sesuai')</script>";
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
            <label for="level" class="col-sm-2 col-form-label">Level</label>
            <div class="col-sm-10">
              <select name="level" id="level" class="form-control" name="level" required>
                <option value="-" disabled>- Pilih -</option>
                <option value="0" <?php echo ($level == 0) ? "selected" : ""; ?>>Administrator
                </option>
                <option value="1" <?php echo ($level == 1) ? "selected" : ""; ?>>Divisi</option>
                <option value="2" <?php echo ($level == 2) ? "selected" : ""; ?>>Supervisor</option>
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

      </div>
    </div>
  </div>
</div>