<?php
$id = $_GET['id'];

$updatePengaduan = mysqli_query($con, "UPDATE pengaduan SET status = 'Ditetapkan', tanggapan = 'Ditanggapi' WHERE pengaduan_id=$id");
if ($updatePengaduan) {
    sweetAlert("success", "Data berhasil ditetapkan", "?page=pengaduan");
} else {
    sweetAlert("error", "Data gagal ditetapkan", "?page=pengaduan");
}
