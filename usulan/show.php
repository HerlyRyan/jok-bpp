<?php
// Usulan Masuk
$queryUsulanMasuk = mysqli_query($con, "SELECT * FROM usulan WHERE status_penetapan = 'Masuk'");
$totalUsulanMasuk = mysqli_num_rows($queryUsulanMasuk);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-primary"><?php echo $title; ?></h1>
</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Usulan Diproses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsulanMasuk; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-inbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Judul Usulan</th>
                                <th>Bidang</th>
                                <th>Program</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                                <th>Tanggal</th>
                                <th>Pengusul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($con, "SELECT 
                                    usulan.usulan_id, 
                                    usulan.judul as judul, 
                                    bidang.nama_bidang as bidang, 
                                    program.nama_program as program,
                                    users.username as pengusul, 
                                    volume,
                                    satuan.nama_satuan as satuan,
                                    tanggal
                                FROM 
                                    usulan 
                                JOIN 
                                    bidang 
                                ON 
                                    usulan.bidang_id = bidang.bidang_id 
                                JOIN 
                                    program 
                                ON 
                                    usulan.program_id = program.program_id
                                JOIN
                                    users
                                ON
                                    users.user_id = usulan.user_id
                                JOIN
                                    satuan
                                ON
                                    satuan.satuan_id = usulan.satuan_id
                                WHERE 
                                    status_penetapan = 'Masuk'");
                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= ucfirst($data['judul']); ?></td>
                                    <td><?= ucfirst($data['bidang']); ?></td>
                                    <td><?= ucfirst($data['program']); ?></td>
                                    <td><?= $data['volume']; ?></td>
                                    <td><?= $data['satuan']; ?></td>
                                    <td><?= $data['tanggal']; ?></td>
                                    <td><?= ucfirst($data['pengusul']); ?></td>
                                    <td>
                                        <div class="d-flex flex-row gap-2 justify-content-end">
                                            <a data-type="terima"
                                                data-id="<?= $data['usulan_id'] ?>"
                                                data-user="<?= $_SESSION['user_id'] ?>"
                                                class="btn btn-success btn-sm btn-verification mr-2">Terima</a>

                                            <a data-type="tolak"
                                                data-id="<?= $data['usulan_id'] ?>"
                                                data-user="<?= $_SESSION['user_id'] ?>"
                                                class="btn btn-danger btn-sm btn-verification">Tolak</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>