<?php
$idOksigen = $_GET['idOksigen'];
$result = mysqli_query($con, "SELECT * FROM tb_oxygen_entry WHERE id_oxygen = '$idOksigen'");
$dataTabung = mysqli_query($con, "SELECT name FROM tb_oxygen_data WHERE id_oxygen = '$idOksigen'");
$tabung = mysqli_fetch_array($dataTabung);
$nama = $tabung['name'];
?>

<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?> <?php echo $nama; ?></h6>
            </div>
            <div class="card-body">
                <a href="?page=stok" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>Serial Number </th>
                                <th>Status </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr>
                                    <td><?php echo $data['serial_number']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
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