<?php
$id = $_GET['id'];

// select data oksigen masuk
$dataOksigenMasuk = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_oxygen_entry WHERE id=$id"));
$idOksigen = $dataOksigenMasuk['id_oxygen'];

$dataOksigenStok = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_oxygen_stocks WHERE id_oxygen= '$idOksigen'"));
$stok = $dataOksigenStok['stocks'];

if ($stok >= 0) {
    // update stok oksigen report
    $result = mysqli_query($con, "DELETE FROM tb_oxygen_entry WHERE id=$id");   
    if ($result) {
        $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE id_oxygen = '$idOksigen' AND status = 'tersedia'");
        $stokOksigen = mysqli_fetch_array($cekStok);
        $stokNow = $stokOksigen['stocks']; 
        mysqli_query($con, "UPDATE tb_oxygen_stocks SET stocks='$stokNow' WHERE id_oxygen=$idOksigen");
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">            
                Swal.fire({
                    
                    icon: "success",
                    title: "Data berhasil dihapus",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=oksigenMasuk";
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
                title: "Gagal menghapus...",
                text: "Cek data return dan keluar!",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "?page=oksigenMasuk";
            });
        });
        </script>
    ';
}   
