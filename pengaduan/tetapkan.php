<?php
$id = $_GET['id'];

$query= mysqli_query($con, "SELECT * FROM rencana_pembangunan WHERE id = '$id'");
$rencana_pembangunan = mysqli_fetch_array($query);
$usulan_id = $rencana_pembangunan['usulan_id'];
// print_r($usulan_id);

$updateUsulan = mysqli_query($con, "UPDATE usulan SET status_penetapan = 'Ditetapkan' WHERE usulan_id=$usulan_id");
$updatePenetapan = mysqli_query($con, "UPDATE rencana_pembangunan SET status_akhir = 'Ditetapkan' WHERE id=$id");
if ($updateUsulan & $updatePenetapan) {
    sweetAlert("success", "Data berhasil ditetapkan", "?page=penetapanRencana");
} else {
    sweetAlert("error", "Data gagal ditetapkan", "?page=penetapanRencana");
}
