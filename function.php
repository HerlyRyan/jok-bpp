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

function sweetAlert($icon, $title, $redirect = null, $timer = 3000)
{
	echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                showConfirmButton: false,
                timer: $timer
            }).then(function() {";

	if ($redirect) {
		echo "window.location.href = '$redirect';";
	}

	echo "});
        });
    </script>";
}

function sweetConfirm($title = "Apakah Anda yakin?", $text = "Data yang sudah dihapus tidak bisa dikembalikan!")
{
	echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('data-url');

                Swal.fire({
                    title: '$title',
                    text: '$text',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
    </script>
    ";
}
