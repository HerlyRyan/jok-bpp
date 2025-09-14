<?php 
$id = $_GET['id'];
$updateExit = mysqli_query($con, "UPDATE tb_oxygen_exit SET status = 'Rejected'  WHERE id = '$id'"); 

$oksigenKeluar = mysqli_query($con, "SELECT * FROM tb_oxygen_exit WHERE id = '$id'");
$oksigen = mysqli_fetch_array($oksigenKeluar);
$serialNumber = $oksigen['serial_number'];
$updateEntry = mysqli_query($con, "UPDATE tb_oxygen_entry SET status = 'tersedia'  WHERE serial_number = '$serialNumber'");

echo "<script>window.location.href = '?page=oksigenKeluar';</script>";
?>