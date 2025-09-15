<div class="row">
    <!-- Data Bidang -->
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Bidang</h6>
                <a href="?page=masterAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Bidang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM bidang");

                                $no = 1;
                                while ($data = mysqli_fetch_array($result)) {
                                ?>

                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['nama_bidang']; ?></td>
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

    <!-- Data Program -->
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Program</h6>
                <a href="?page=masterAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Program</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM bidang");

                                $no = 1;
                                while ($data = mysqli_fetch_array($result)) {
                                ?>

                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['nama_bidang']; ?></td>
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

    <!-- Data Satuan -->
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Satuan</h6>
                <a href="?page=masterAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $result = mysqli_query($con, "SELECT * FROM bidang");

                                $no = 1;
                                while ($data = mysqli_fetch_array($result)) {
                                ?>

                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['nama_bidang']; ?></td>
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
</div>