<?php
if (isset($_POST['submit'])) {
	$idOksigen 		= $_POST['idOksigen'];	
    $inputDate= new dateTime($_POST['tangalKembali']);
    $tanggalKembali= $inputDate->format('Y-m-d');
	$noDO 	        = $_POST['noDO'];
	$serialNumber 	= $_POST['serialNumber'];	
    $keterangan = $_POST['keterangan'];

    if ($hasilStok >= 0) {        
        $updateEntry = mysqli_query($con, "UPDATE tb_oxygen_entry SET status = 'refill'  WHERE serial_number = '$serialNumber'"); 

        $result = mysqli_query($con, "INSERT INTO tb_oxygen_return(id_oxygen, return_date, no_do, serial_number, keterangan) VALUES('$idOksigen','$tanggalKembali', '$noDO', '$serialNumber', '$keterangan')");
        if ($result) {
            $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE id_oxygen = '$idOksigen' AND status = 'tersedia'");
            $stokOksigen = mysqli_fetch_array($cekStok);
            $stokNow = $stokOksigen['stocks']; 
            if ($stokNow >= 0) {
                mysqli_query($con, "UPDATE tb_oxygen_stocks SET stocks='$stokNow' WHERE id_oxygen=$idOksigen");
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script type="text/javascript">
                    Swal.fire({
                        
                        icon: "success",
                        title: "Data berhasil disimpan",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = "?page=oksigenReturn";
                    });
                </script>
                ';
            } else {
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script type="text/javascript">
                        Swal.fire({
                                    
                                icon: "error",
                                title: "Stok tabung sudah habis",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = "?page=oksigenReturn";
                            });
                    </script>
                ';
            }
        } 
    } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
                Swal.fire({
                            
                        icon: "error",
                        title: "Stok tabung sudah habis",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = "?page=oksigenReturn";
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
                            <select name="idOksigen" class="form-control" id="idOksigen" required onchange="updateSelected()">
                                <option value="-" selected>- Pilih ID Oksigen -</option>
                                <?php
                                    include "connection.php";
                                    $query = mysqli_query($con, "SELECT * FROM tb_oxygen_data ORDER BY id_oxygen ASC");
                                    while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?= $data['id_oxygen'] ?>"><?= $data['id_oxygen'] ?> - <?php echo $data['name'] ?></option>
                                <?php 
                                } 
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="serialNumber" class="col-sm-2 col-form-label">Serial Number</label>          
                        <div class="col-sm-10">
                            <select name="serialNumber" class="form-control" id="serialNumber" required>
                                <option value="-" selected>- Pilih Serial Number -</option>                   
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tanggalKembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggalKembali" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="noDO" class="col-sm-2 col-form-label">Nomor DO</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="noDO" placeholder="masukan nomor DO..." required>
                        </div>
                    </div>
                 
                    <div class="mb-3 row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="keterangan" placeholder="masukan keterangan..." required>
                        </div>
                    </div>                    

                    <div class="row">
                        <div class="col offset-md-2">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="?page=oksigenReturn" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updateSelected(){
        const idOksigen = document.getElementById('idOksigen').value;        

        updateSerialNumberJS(idOksigen)
    }

    function updateSerialNumberJS(idOksigen){            
        const optionSerialNumber = document.getElementById('serialNumber')
        // console.log(idOksigen)

        if (idOksigen == '00006171') {
            optionSerialNumber.innerHTML = `
                <option value="-" selected>- Pilih Serial Number -</option>
                <?php
                    include "connection.php";
                    $query = mysqli_query($con, "SELECT * FROM tb_oxygen_entry WHERE id_oxygen = '00006171'");   
                    while ($data = mysqli_fetch_array($query)) {
                        if ($data['status'] == 'kosong') {
                            $serialNumbers = $data['serial_number'];                                    
                            echo "<option value='$serialNumbers'>$serialNumbers</option>";
                        }
                    }
                ?>
            ` 
        } else if (idOksigen == '00006172') {
           optionSerialNumber.innerHTML = `
                <option value="-" selected>- Pilih Serial Number -</option>
                <?php
                    include "connection.php";
                    $query = mysqli_query($con, "SELECT * FROM tb_oxygen_entry WHERE id_oxygen = '00006172'");   
                    while ($data = mysqli_fetch_array($query)) {
                        if ($data['status'] == 'kosong') {
                            $serialNumbers = $data['serial_number'];                                    
                            echo "<option value='$serialNumbers'>$serialNumbers</option>";
                        }
                    }
                ?>
            `  
        }      
    }
</script>