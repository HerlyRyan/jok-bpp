<?php
$id = $_GET['id'];

$result = mysqli_query($con, "DELETE FROM tb_oxygen_data WHERE id=$id");
echo "<script>window.location.href = '?page=master';</script>";
