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
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Usulan Diajukan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsulanMasuk; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-inbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Usulan Layak</div>
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

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Usulan Tidak Layak</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsulanDitetapkan; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col">
        <a href="?page=usulanAdd" class="btn btn-primary btn-block mb-4">Buat Usulan Baru</a>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Usulan</h6>

            </div>
            <div class="card-body">

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataKategori" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Judul Usulan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $result = mysqli_query($con, "SELECT * FROM usulan");

                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {

                            ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?php echo ucfirst($data['usulan']); ?></td>
                                    <td><?php echo $data['tanggal']; ?> </td>
                                    <td> <?php echo $data['status_penetapan']; ?> </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>