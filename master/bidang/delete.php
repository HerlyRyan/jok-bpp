<?php
$id = $_GET['id'];

$result = mysqli_query($con, "DELETE FROM bidang WHERE bidang_id=$id");
if ($result) {
    sweetAlert("success", "Data berhasil dihapus", "?page=master");
}