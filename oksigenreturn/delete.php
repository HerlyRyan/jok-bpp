<?php
$id = $_GET['id'];

// select data oksigen return
$dataOksigenKembali = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_oxygen_return WHERE id=$id"));
$idOksigenKembali = $dataOksigenKembali['id_oxygen'];
$serialOksigenKembali = $dataOksigenKembali['serial_number'];

// delete data oksigen return
$result = mysqli_query($con, "DELETE FROM tb_oxygen_return WHERE id=$id");

if ($result) {
    $updateEntry = mysqli_query($con, "UPDATE tb_oxygen_entry SET status = 'kosong'  WHERE serial_number = '$serialOksigenKembali'");

    if ($updateEntry) {        
        $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE id_oxygen = '$idOksigenKembali' AND status = 'tersedia'");
        $stokOksigen = mysqli_fetch_array($cekStok);
        $stokNow = $stokOksigen['stocks']; 

        $updateStok= mysqli_query($con, "UPDATE tb_oxygen_stocks SET stocks='$stokNow' WHERE id_oxygen=$idOksigenKembali");
        if ($updateStok) {        
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">            
                Swal.fire({
                    icon: "success",
                    title: "Data berhasil dihapus",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=oksigenReturn";
                });
            </script>
            ';
        }
    }
}

?>
