<?php

if (isset($_POST['submit'])) {
    $idOksigen = $_POST['idOksigen'];
    $entry = $_POST['entry_date'];
    $keterangan = $_POST['keterangan'];
    $serialNumber = $_POST['serialNumber'];
    $kondisi = $_POST['kondisi'];
    $array = explode(',', $serialNumber);
    $jumlah = count($array);

    foreach ($array as $serial) {
        $insert = mysqli_query($con, "INSERT INTO tb_oxygen_entry(id_oxygen, entry_date, keterangan, serial_number, status) VALUES('$idOksigen', '$entry', '$keterangan', '$serial', '$kondisi')");
    }


    if ($insert) {
        $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE id_oxygen = '$idOksigen' AND status = 'tersedia'");
        $stokOksigen = mysqli_fetch_array($cekStok);
        $stokNow = $stokOksigen['stocks'];
        $updateStok = mysqli_query($con, "UPDATE tb_oxygen_stocks SET stocks='$stokNow' WHERE id_oxygen=$idOksigen");
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">            
                Swal.fire({
                    
                    icon: "success",
                    title: "Data berhasil disimpan",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=oksigenMasuk";
                });
            </script>
        ';
    }
}

?>

<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
            </div>
            <div class="card-body">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formBarangMasuk">
                    <i class="fas fa-plus"></i> Tambah
                </button>
                <hr>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataBarangMasuk" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Waktu Masuk</th>
                                <th>ID Oksigen</th>
                                <th>Keterangan</th>
                                <th>Serial Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $result = mysqli_query($con, "SELECT * FROM tb_oxygen_entry");
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['entry_date'] ?></td>
                                    <td><?php echo $data['id_oxygen'] ?></td>
                                    <td><?php echo $data['keterangan'] ?></td>
                                    <td><?php echo $data['serial_number'] ?></td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="edit data" class="btn btn-sm btn-circle btn-success" href="?page=oksigenMasukEdit&id=<?php echo $data['id']; ?>"><i class="fa fa-pen"></i></a>
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

<div class="modal fade" id="formBarangMasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Tambah Data</h4>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="idOksigen">ID Oksigen</label>
                        <select name="idOksigen" class="form-control" required>
                            <option value="-" selected>- Pilih ID Oksigen -</option>
                            <?php
                            include "connection.php";
                            $query = mysqli_query($con, "SELECT * FROM tb_oxygen_data ORDER BY id_oxygen ASC");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?= $data['id_oxygen'] ?>"><?= $data['id_oxygen'] ?> - <?= $data['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="entry_date">Tanggal Masuk</label>
                        <input type="date" name="entry_date" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="serialNumber">Serial Number</label>
                        <input type="text" name="serialNumber" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="kondisi">Kondisi</label>
                        <select name="kondisi" class="form-control" id="status" required>
                            <option value="-" selected>- Pilih Status -</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="kosong">Kosong</option>
                        </select>
                    </div>

                    <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
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
                window.location.href = "?page=oksigenMasukDelete&id=" + id;
            }
        })
    }
</script>