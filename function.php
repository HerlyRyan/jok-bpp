<?php
function rupiah($angka)
{
	$hasil = 'Rp ' . number_format($angka, 2, ",", ".");
	return $hasil;
}

function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tgl($tanggal)
{
	$bulan = array(
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Juni',
		'Juli',
		'Agus',
		'Sept',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function chartTabung($con)
{
	$query = mysqli_query($con, "SELECT 
		o.id_oxygen, 
		o.NAME, 
		COALESCE(COUNT(e.id_oxygen), 0) AS pemakaian
	FROM tb_oxygen_data o
	LEFT JOIN tb_oxygen_exit e ON o.id_oxygen = e.id_oxygen
	GROUP BY o.id_oxygen, o.NAME
	ORDER BY pemakaian DESC;
	");

	return $query;
}

function chartDivisi($con)
{
	$query = mysqli_query($con, "SELECT 
		u.username, 
		COALESCE(COUNT(e.id_oxygen), 0) AS pemakaian 
	FROM user u 
	JOIN tb_oxygen_exit e ON u.username = e.user 
	GROUP BY user 
	ORDER BY pemakaian DESC");

	return $query;
}
