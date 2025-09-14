<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>

            </div>
            <div class="card-body">
                <a href="?page=oksigenReturnAdd" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah
                </a>
                <a class="btn btn-info" href="../oksigenreturn/printsuratjalan.php" target="_blank">
                    <i class="fas fa-print"></i> Cetak Surat Jalan
                </a>
                <hr>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataKategori" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Waktu Kembali</th>
                                <th>ID Oksigen</th>
                                <th>Serial Number</th>
                                <th>No DO</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $result = mysqli_query($con, "SELECT * FROM tb_oxygen_return");

                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['return_date']; ?></td>
                                    <td><?php echo $data['id_oxygen']; ?></td>
                                    <td><?php echo $data['serial_number']; ?></td>
                                    <td><?php echo $data['no_do']; ?></td>
                                    <td><?php echo $data['keterangan']; ?></td>
                                    <td>
                                        <!-- <a data-toggle="tooltip" data-placement="top" title="edit data" class="btn btn-sm btn-circle btn-success" href="?page=oksigenReturnEdit&id=<?php echo $data['id']; ?>"><i class="fa fa-pen"></i></a> -->

                                        <a data-toggle="tooltip" data-placement="top" title="hapus data" class="btn btn-sm btn-circle btn-danger" onclick="deleteData(<?php echo $data['id']; ?>)"><i class="fa fa-trash"></i></a>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function deleteData(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?page=oksigenReturnDelete&id=" + id;
            }
        })
    }
</script>