<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>

            </div>
            <div class="card-body">

                <a href="?page=userAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>

                <a href="../user/print.php" target="_blank" class="btn 
                btn-success"><i class="fas fa-print"></i> Cetak</a>
                <hr>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataKategori" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $result = mysqli_query($con, "SELECT * FROM users");

                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {

                            ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?php echo ucfirst($data['username']); ?></td>
                                    <td><?php echo $data['role']; ?></td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="edit data" class="btn btn-sm btn-circle btn-success" href="?page=userEdit&id=<?php echo $data['user_id']; ?>"><i class="fa fa-pen"></i></a>

                                        <a data-toggle="tooltip" data-placement="top" title="hapus data" class="btn btn-sm btn-circle btn-danger btn-delete" href="#" data-url="?page=userDelete&id=<?php echo $data['user_id']; ?>"><i class="fa fa-trash"></i></a>

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