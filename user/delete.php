<?php
$id = $_GET['id'];

$result = mysqli_query($con, "SELECT * FROM users WHERE user_id=$id");
$data = mysqli_fetch_array($result);

$username = $data['username'];
session_start();
if ($_SESSION['username'] == $username) {
    echo "<script>alert('Tidak dapat menghapus user yang sedang login')</script>";
} else {
    $result = mysqli_query($con, "DELETE FROM users WHERE user_id=$id");
    if ($result) {
        sweetAlert("success", "Data berhasil dihapus", "?page=user");
    }
}
