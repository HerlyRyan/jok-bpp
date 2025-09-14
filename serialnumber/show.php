<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
            </div>
            <div class="card-body">
                <a href="../serialnumber/print.php" class="btn btn-success" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
                <hr>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataBarangMasuk" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>ID Oksigen </th>
                                <th>Nama</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Tanggal Return</th>
                                <th>Serial Number</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $result = mysqli_query($con, "
                                SELECT 
                                    e.id_oxygen, 
                                    d.name AS name, 
                                    e.entry_date, 
                                    ex.exit_date, 
                                    r.return_date, 
                                    e.serial_number, 
                                    e.status
                                FROM tb_oxygen_entry e
                                LEFT JOIN tb_oxygen_data d ON d.id_oxygen = e.id_oxygen
                                LEFT JOIN tb_oxygen_exit ex ON ex.serial_number = e.serial_number
                                LEFT JOIN tb_oxygen_return r ON r.serial_number = e.serial_number
                            ");

                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr class="text-center">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['id_oxygen']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?= $data['entry_date'] ? tgl($data['entry_date']) : '-' ?></td>
                                    <td><?= $data['exit_date'] ? tgl($data['exit_date']) : '-' ?></td>
                                    <td><?= $data['return_date'] ? tgl($data['return_date']) : '-' ?></td>
                                    <td><?php echo $data['serial_number']; ?></td>
                                    <td><?php echo strtoupper($data['status']); ?></td>
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