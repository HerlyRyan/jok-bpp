<?php
include 'connection.php';
include 'function.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordKonfirmasi = $_POST['passwordKonfirmasi'];
    $role = 'user_desa';
    $passHash = password_hash($password, PASSWORD_DEFAULT);

    if ($password === $passwordKonfirmasi) {
        mysqli_query($con, "INSERT INTO users (username, password, role) VALUES('$username', '$passHash', '$role')");
        // echo "<script>window.location.href = './';</script>";
        sweetAlert("success", "Pendaftaran Berhasil", "./");
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

    <title>Register User</title>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <div class="text-center text-primary mt-4">
                            <i class="fas fa-3x fa-lock"></i>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register User</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="username" name="username" class="form-control form-control-user" placeholder="masukan username...">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="masukan password...">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="passwordKonfirmasi" class="form-control form-control-user" placeholder="masukan konfirmasi password...">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="submit">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($error)) : ?>
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Registarsi gagal</strong>, Periksa kembali password
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