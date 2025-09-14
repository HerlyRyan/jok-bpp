<?php
$id = $_GET['id'];

$oksigenMasuk = mysqli_query($con, "SELECT * FROM tb_oxygen_exit WHERE id = '$id'");
$oksigen = mysqli_fetch_array($oksigenMasuk);
$idOksigen = $oksigen['id_oxygen'];
$serialNumber = $oksigen['serial_number'];
// print_r($idOksigen);

$updateEntry = mysqli_query($con, "UPDATE tb_oxygen_entry SET status = 'terpakai'  WHERE serial_number = '$serialNumber'");

$updateExit = mysqli_query($con, "UPDATE tb_oxygen_exit SET status = 'Accepted'  WHERE id = '$id'");

if ($updateEntry && $updateExit) {
    $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE id_oxygen = '$idOksigen' AND status = 'tersedia'");
    $stokOksigen = mysqli_fetch_array($cekStok);
    $stokNow = $stokOksigen['stocks'];
    mysqli_query($con, "UPDATE tb_oxygen_stocks SET stocks='$stokNow' WHERE id_oxygen=$idOksigen");
    echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({                    
                icon: "success",
                title: "Permintaan berhasil disimpan",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "?page=oksigenKeluar";
            });
        });
        </script>
    ';
}
