<?php
if (isset($_POST['submit'])) {
	$idOksigen 		= $_POST['idOksigen'];
	$name       	= $_POST['name'];

    $query = mysqli_query($con, "SELECT * FROM tb_oxygen_stocks WHERE id_oxygen = '$idOksigen'");
    $dataTabung = mysqli_fetch_array($query);
    $idData = $dataTabung['id_oxygen'];

    
    if ($idOksigen !== $idData) {        
        $result = mysqli_query($con, "INSERT INTO tb_oxygen_data(id_oxygen, name) VALUES('$idOksigen','$name')");
        $insert = mysqli_query($con, "INSERT INTO tb_oxygen_stocks(id_oxygen, stocks) VALUES('$idOksigen',0)");
        if ($result && $insert) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({                    
                    icon: "success",
                    title: "Data berhasil disimpan",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=master";
                });
            });
            </script>
            ';
        }
    } else {
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    
                    icon: "error",
                    title: "ID sudah ada",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=master";
                });
            });
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
                            <input type="text" class="form-control" name="idOksigen" placeholder="Masukan ID Oksigen..." required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Oksigen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Masukan Nama Oksigen..." required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col offset-md-2">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="?page=master" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>