<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Aplikasi Bapperida Pulang Pisau</title>
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    * {
        font-family: Helvetica;
    }
</style>
</head>

<body id="page-top">
    <div id="wrapper">

        <?php
        include_once '../layout/menu.php';
        include_once '../function.php';
        include_once '../logincheck.php';
        ?>
        <!-- main content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once '../layout/navbar.php' ?>

                <!-- section content -->
                <div class="container-fluid">
                    <?php
                    include_once '../connection.php';
                    error_reporting(0);
                    if ($_SESSION['level'] == 2) {
                        switch ($_GET['page']) {
                            default:
                                include "dashboard.php";
                                break;

                            case "dashboard";
                                $title = 'Dashboard';
                                include 'dashboard.php';
                                break;

                            //Laporan
                            case "laporanMasuk";
                                $title = 'Laporan Tabung Masuk';
                                include '../laporan/masuk.php';
                                break;

                            case "laporanKeluar";
                                $title = 'Laporan Tabung Keluar';
                                include '../laporan/keluar.php';
                                break;

                            case "laporanReturn";
                                $title = 'Laporan Tabung Return';
                                include '../laporan/return.php';
                                break;

                            case "laporanPemakaianTabung";
                                $title = 'Laporan Pemakaian Tabung';
                                include '../laporan/pemakaianTabung.php';
                                break;

                            case "laporanPemakaianDivisi";
                                $title = 'Laporan Pemakaian Divisi';
                                include '../laporan/pemakaianDivisi.php';
                                break;

                            //  Oksigen stok
                            case "stok";
                                $title = 'Laporan Stok Tabung';
                                include '../stok/show.php';
                                break;

                            case "stokDetail";
                                $title = 'Data Stok Detail';
                                include '../stok/detail.php';
                                break;

                            case "stokPrint";
                                include '../stok/print.php';
                                break;

                            // Tracking Serial Number
                            case "trackingSerialNumber";
                                $title = 'Laporan Serial Number';
                                include '../serialnumber/show.php';
                                break;
                        }
                    }
                    ?>

                </div>
            </div>

            <?php include_once '../layout/footer.php' ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout dari Aplikasi?</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include_once '../layout/js.php' ?>
    <?php
    sweetConfirm()
    ?>
</body>

</html>