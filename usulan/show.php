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
                                <th>Nama Kegiatan</th>
                                <th>Pengusul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($con, "SELECT usulan.usulan_id, usulan.judul as judul, users.username as pengusul FROM usulan JOIN users ON usulan.user_id = users.user_id WHERE status_penetapan = 'Masuk'");
                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= ucfirst($data['judul']); ?></td>
                                    <td><?= ucfirst($data['pengusul']); ?></td>
                                    <td>
                                        <a data-type="terima"
                                            data-id="<?= $data['usulan_id'] ?>"
                                            data-user="<?= $_SESSION['user_id'] ?>"
                                            class="btn btn-success btn-sm btn-action">Terima</a>

                                        <a data-type="tolak"
                                            data-id="<?= $data['usulan_id'] ?>"
                                            data-user="<?= $_SESSION['user_id'] ?>"
                                            class="btn btn-danger btn-sm btn-action">Tolak</a>

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