<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>

            </div>
            <div class="card-body">

                <a href="?page=masterAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>

                <!-- <a href="../master/print.php" target="_blank" class="btn 
                btn-success"><i class="fas fa-print"></i> Cetak</a> -->

                <hr>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataKategori" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>ID Oksigen</th>
                                <th>Nama Oksigen</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $result = mysqli_query($con, "SELECT * FROM tb_oxygen_data ORDER BY id_oxygen ASC");

                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['id_oxygen']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="edit data" class="btn btn-sm btn-circle btn-success" href="?page=masterEdit&id=<?php echo $data['id']; ?>"><i class="fa fa-pen"></i></a>

                                        <a data-toggle="tooltip" data-placement="top" title="hapus data" class="btn btn-sm btn-circle btn-danger" href="?page=masterDelete&id=<?php echo $data['id']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fa fa-trash"></i></a>

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