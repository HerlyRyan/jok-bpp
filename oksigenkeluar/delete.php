<?php
$id = $_GET['id'];

// select data oksigen keluar
$dataOksigenKeluar = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_oxygen_exit WHERE id=$id"));
$idOksigenKeluar = $dataOksigenKeluar['id_oxygen'];
$serialOksigenKeluar = $dataOksigenKeluar['serial_number'];
$status = $dataOksigenKeluar['status'];
// print_r($serialOksigenKeluar);
if ($status == 'Rejected') {
    $result = mysqli_query($con, "DELETE FROM tb_oxygen_exit WHERE id=$id");
    if ($result) {
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">            
                Swal.fire({                
                    icon: "success",
                    title: "Data berhasil dihapus",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=oksigenKeluar";
                });
            </script>
        ';
    }
}

if ($status == 'Accepted') {
    $updateEntry = mysqli_query($con, "UPDATE tb_oxygen_entry SET status = 'tersedia'  WHERE serial_number = '$serialOksigenKeluar'"); 

    $result = mysqli_query($con, "DELETE FROM tb_oxygen_exit WHERE id=$id");
    if ($result && $updateEntry) {
        $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE id_oxygen = '$idOksigenKeluar' AND status = 'tersedia'");
        $stokOksigen = mysqli_fetch_array($cekStok);
        $stokNow = $stokOksigen['stocks']; 
        mysqli_query($con, "UPDATE tb_oxygen_stocks SET stocks='$stokNow' WHERE id_oxygen=$idOksigenKeluar");
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">            
                Swal.fire({                
                    icon: "success",
                    title: "Data berhasil dihapus",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=oksigenKeluar";
                });
            </script>
        ';
    }
}