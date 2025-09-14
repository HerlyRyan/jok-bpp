<!-- <?php
    $query = mysqli_query($con,"SELECT * FROM tb_oxygen_data");
    $totalKategori = mysqli_num_rows($query);
    
    $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE status = 'tersedia'");
    $stokOksigen = mysqli_fetch_array($cekStok);
    $stokTotal = $stokOksigen['stocks']; 
    
    $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE status = 'tersedia' AND id_oxygen = '00006171'");
    $stokOksigen = mysqli_fetch_array($cekStok);
    $stokOksigenTersedia = $stokOksigen['stocks'];

    $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE status = 'tersedia' AND id_oxygen = '00006172'");
    $stokOksigen = mysqli_fetch_array($cekStok);
    $stokAceTersedia = $stokOksigen['stocks'];

    $query = mysqli_query($con,"SELECT * FROM tb_oxygen_return");
    $totalSupplier = mysqli_num_rows($query);    

    $query = mysqli_query($con,"SELECT * FROM user");
    $totalUser = mysqli_num_rows($query);

    $query = mysqli_query($con,"SELECT * FROM tb_oxygen_entry");
    $totalBarangMasuk = mysqli_num_rows($query);

    $query = mysqli_query($con,"SELECT * FROM tb_oxygen_exit");
    $totalBarangKeluar = mysqli_num_rows($query);

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title;?></h1>
</div>

<div class="row">
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalUser ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user        fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Data Tabung</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $totalKategori ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Transaksi Tabung Return</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalSupplier ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-truck fa-2x text-gray-300"></i>
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
                            Transaksi Tabung Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBarangMasuk ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-level-down-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Transaksi Tabung Keluar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBarangKeluar ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-level-up-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->