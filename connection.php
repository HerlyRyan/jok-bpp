<?php 
	$databaseHost 		= "localhost";
	$databaseName		= "bapperida-pulang-pisau";
	$databaseUsername 	= "root";
	$databasePassword	= "";

	$con = mysqli_connect("$databaseHost","$databaseUsername","$databasePassword","$databaseName");

    // $con = mysqli_connect('localhost','root','root','bapperida-pulang-pisau');

	if (mysqli_connect_errno()) {
		echo "<h1>Koneksi database error : " . mysqli_connect_errno() . "</h1>";
	}

	
?>