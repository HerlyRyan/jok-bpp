<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM tb_oxygen_entry WHERE id=$id");
while ($data = mysqli_fetch_array($result)) {
    $idOksigen         = $data['id_oxygen'];
    $tanggalMasuk    = $data['entry_date'];
    $serialNumber   = $data['serial_number'];
    $keterangan     = $data['keterangan'];
}

if (isset($_POST['submit'])) {
    $idOksigen         = $_POST['idOksigen'];
    $tanggalMasuk   = $_POST['tanggalMasuk'];
    $serialNumber    = $_POST['serial_number'];
    $keterangan     = $_POST['keterangan'];

    $result = mysqli_query($con, "UPDATE tb_oxygen_entry SET id_oxygen='$idOksigen', entry_date='$tanggalMasuk', serial_number='$serialNumber', keterangan='$keterangan' WHERE id=$id");
    if ($result) {
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
                Swal.fire({        
                    icon: "success",
                    title: "Data berhasil diubah",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=oksigenMasuk";
                });
            </script>
            ';
    } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            Swal.fire({       
                icon: "error",
                title: "Stok tabung tidak mencukupi",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "?page=oksigenMasuk";
            );
        </script>
        ';
    }
}
?>

<div class="row">
    <div class="col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="idOksigen" class="col-sm-2 col-form-label">ID Oksigen</label>
                        <div class="col-sm-10">
                            <select name="idOksigen" id="idOksigen" class="form-control" name="idOksigen" required>
                                <option value="" selected>- pilih ID Oksigen -</option>
                                <?php
                                include "connection.php";
                                $query = mysqli_query($con, "SELECT * FROM tb_oxygen_data");
                                while ($data = mysqli_fetch_array($query)) {
                                    $idOksigenData = $data['id_oxygen'];
                                ?>
                                    <option value="<?= $idOksigenData ?>" <?php echo ($idOksigen == $idOksigenData) ? "selected" : "" ?>><?php echo $data['id_oxygen'] ?> - <?php echo $data['name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggalMasuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggalMasuk" value="<?php echo $tanggalMasuk ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="serial_number" class="col-sm-2 col-form-label">Serial Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="serial_number" placeholder="masukan serial number..." value="<?php echo $serialNumber ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="keterangan" placeholder="masukan keterangan..." value="<?php echo $keterangan ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col offset-md-2">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="?page=oksigenMasuk" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>