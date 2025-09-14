<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM tb_oxygen_data WHERE id=$id");
while ($data = mysqli_fetch_array($result)) {
    $idOksigen = $data['id_oxygen'];
    $name = $data['name'];
}



if (isset($_POST['submit'])) {
    $idOksigen 		= $_POST['idOksigen'];
    $name       	= $_POST['name'];
    $result = mysqli_query($con, "UPDATE tb_oxygen_data SET id_oxygen='$idOksigen', name='$name' WHERE id=$id");
    echo "<script>window.location.href ='?page=master';</script>";
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
                            <input type="text" class="form-control" name="idOksigen" value="<?php echo $idOksigen ?>" placeholder="ID Oksigen" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Oksigen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="<?php echo $name ?>" required>
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
