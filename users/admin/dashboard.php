<?php
// Usulan Masuk
$queryUsulanMasuk = mysqli_query($con, "SELECT * FROM usulan WHERE status_penetapan = 'Masuk'");
$totalUsulanMasuk = mysqli_num_rows($queryUsulanMasuk);

// Usulan Diverifikasi
$queryUsulanDiverifikasi = mysqli_query($con, "SELECT * FROM usulan WHERE status_penetapan = 'Diverifikasi'");
$totalUsulanDiverifikasi = mysqli_num_rows($queryUsulanDiverifikasi);

// Usulan Ditetapkan
$queryUsulanDitetapkan = mysqli_query($con, "SELECT * FROM usulan WHERE status_penetapan = 'Ditetapkan'");
$totalUsulanDitetapkan = mysqli_num_rows($queryUsulanDitetapkan);

// Pengaduan
$queryPengaduan = mysqli_query($con, "SELECT * FROM pengaduan");
$totalPengaduan = mysqli_num_rows($queryPengaduan);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-primary"><?php echo $title; ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-xl-5 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Usulan Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsulanMasuk; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-inbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Usulan Diverifikasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $totalUsulanDiverifikasi; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-5 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Usulan Ditetapkan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsulanDitetapkan; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pengaduan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $totalPengaduan; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>