<?php
include 'connection.php';
session_start();
$data = mysqli_query($con, "SELECT * FROM users");
$rowCount = mysqli_num_rows($data);

if ($rowCount == 0) {
    $zerouser = true;
    $_SESSION['status'] = 'addUser';
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    $cek = mysqli_num_rows($result);
    list($user_id, $u, $p, $r) = mysqli_fetch_array($result);

    if ($cek != 0) {
        if (password_verify($password, $p)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $u;
            $_SESSION['role'] = $r;
            $_SESSION['status'] = 'login';
            if ($_SESSION['status']) {
                if ($_SESSION['role'] == 'user_desa') {
                    header('Location: users/user-desa/?page=dashboard');
                } else if ($_SESSION['role'] == 'pimpinan') {
                    header('Location: users/pimpinan/?page=dashboard');
                } else {
                    header('Location: users/admin/?page=dashboard');
                }
            }
        }
        $error = true;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login User</title>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        * {
            font-family: Helvetica;
        }
    </style>

</head>

<body class="bg-login-image">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <div class="text-center text-primary mt-4">
                            <!-- <img src="./assets/img/logo-dsp.png" alt="" class="img-responsive" width="150" height="100"> -->
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-12">
                                                <input type="username" name="username" class="form-control" placeholder="masukan username...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-12">
                                                <input type="password" name="password" class="form-control" placeholder="masukan password...">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-block" name="login">LOGIN</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($error)) : ?>
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Login gagal</strong> Periksa kembali Username dan Password
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($zerouser)) : ?>
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Belum ada data user, silahkan buat user baru untuk masuk kedalam aplikasi.

                                    <a href="register.php" class="btn-link">Buat user baru</a>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>