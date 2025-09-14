<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
            </div>
            <div class="card-body">
                <a href="../stok/print.php" class="btn btn-success" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
                <hr>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataBarangMasuk" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>ID Oksigen </th>
                                <th>Nama</th>
                                <th>Tersedia </th>
                                <th>Terpakai </th>
                                <th>Kosong </th>
                                <th>Refill </th>
                                <th>Total </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $result = mysqli_query($con, "SELECT tb_oxygen_stocks.id_oxygen, tb_oxygen_data.name, (SELECT COUNT(id_oxygen) FROM tb_oxygen_entry WHERE STATUS = 'tersedia' AND id_oxygen = tb_oxygen_stocks.id_oxygen) AS stok_tersedia, (SELECT COUNT(id_oxygen) FROM tb_oxygen_entry WHERE STATUS = 'terpakai' AND id_oxygen = tb_oxygen_stocks.id_oxygen) AS terpakai, (SELECT COUNT(id_oxygen) FROM tb_oxygen_entry WHERE STATUS = 'kosong' AND id_oxygen = tb_oxygen_stocks.id_oxygen) AS kosong, (SELECT COUNT(id_oxygen) FROM tb_oxygen_entry WHERE STATUS = 'refill' AND id_oxygen = tb_oxygen_stocks.id_oxygen) AS refill, (SELECT COUNT(id_oxygen) FROM tb_oxygen_entry WHERE id_oxygen = tb_oxygen_stocks.id_oxygen) AS total FROM tb_oxygen_stocks JOIN tb_oxygen_data ON tb_oxygen_stocks.id_oxygen = tb_oxygen_data.id_oxygen ORDER BY tb_oxygen_stocks.id_oxygen ASC");

                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr class="text-center">
                                    <td><?php echo $data['id_oxygen']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['stok_tersedia']; ?> </td>
                                    <td><?php echo $data['terpakai']; ?> </td>
                                    <td><?php echo $data['kosong']; ?> </td>
                                    <td><?php echo $data['refill']; ?> </td>
                                    <td><?php echo $data['total']; ?> Tabung</td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="detail" class="btn btn-sm btn-circle btn-success" href="?page=stokDetail&idOksigen=<?php echo $data['id_oxygen']; ?>"><i class="fa fa-eye"></i></a>
                                        <a data-toggle="tooltip" data-placement="top" title="cetak" class="btn btn-sm btn-circle btn-primary" href="../stok/printDetail.php?idOksigen=<?php echo $data['id_oxygen']; ?>" target="_blank"><i class="fa fa-print"></i></a>
                                    </td>
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