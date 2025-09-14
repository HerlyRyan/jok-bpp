<?php
$id = $_GET['id'];

$result = mysqli_query($con,"SELECT * FROM user WHERE id=$id");
$data = mysqli_fetch_array($result);

$username = $data['username'];
session_start();
if ($_SESSION['username'] == $username) {
    echo "<script>alert('Tidak dapat menghapus user yang sedang login')</script>";
} else {
    $result = mysqli_query($con, "DELETE FROM user WHERE id=$id");
}
echo "<script>window.location.href = '?page=user';</script>";
