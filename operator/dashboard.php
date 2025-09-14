<?php

$cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE status = 'tersedia'");
$stokOksigen = mysqli_fetch_array($cekStok);
$stokTotal = $stokOksigen['stocks'];

$cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE status = 'tersedia' AND id_oxygen = '00006171'");
$stokOksigen = mysqli_fetch_array($cekStok);
$stokOksigenTersedia = $stokOksigen['stocks'];

$cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE status = 'tersedia' AND id_oxygen = '00006172'");
$stokOksigen = mysqli_fetch_array($cekStok);
$stokAceTersedia = $stokOksigen['stocks'];

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Stok Tersedia</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stokTotal ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x text-gray-300"></i>
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
                            Stok Tersedia Oksigen</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stokOksigenTersedia ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x text-gray-300"></i>
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
                            Stok Tersedia Acetylene</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stokAceTersedia ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>