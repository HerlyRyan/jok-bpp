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

function sweetConfirm()
{
	echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const actionButtons = document.querySelectorAll('.btn-action');

        actionButtons.forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const url   = this.getAttribute('data-url');
                const type  = this.getAttribute('data-type'); // terima / tolak / tetapkan
                let title   = 'Apakah Anda yakin?';
                let text    = '';
                let icon    = 'warning';
                let confirm = 'Ya, lanjutkan!';

                switch (type) {
                    case 'terima':
                        title   = 'Terima Usulan?';
                        text    = 'Usulan akan diberi status Diverifikasi.';
                        icon    = 'question';
                        confirm = 'Ya, Terima';
                        break;
                    case 'tolak':
                        title   = 'Tolak Usulan?';
                        text    = 'Usulan akan ditolak dan tidak diproses lebih lanjut.';
                        icon    = 'error';
                        confirm = 'Ya, Tolak';
                        break;
                    case 'tetapkan':
                        title   = 'Tetapkan Usulan?';
                        text    = 'Usulan akan ditetapkan secara final.';
                        icon    = 'success';
                        confirm = 'Ya, Tetapkan';
                        break;
                    case 'hapus':
                        title   = 'Apakah Anda yakin?';
                        text    = 'Data yang sudah dihapus tidak bisa dikembalikan!';
                        icon    = 'warning';
                        confirm = 'Ya, Hapus';
                        break;
                }

                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirm,
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

function sweetModalVerifikasi()
{
	echo <<<HTML
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
	document.addEventListener("DOMContentLoaded", function () {
    	const actionButtons = document.querySelectorAll(".btn-action");

    	actionButtons.forEach(button => {
        	button.addEventListener("click", function (e) {
            	e.preventDefault();

            	const type  = this.getAttribute("data-type");  // terima/tolak
            	const id    = this.getAttribute("data-id");
            	const user  = this.getAttribute("data-user");

            	let title   = (type === "terima") ? "Verifikasi Usulan - Terima" : "Verifikasi Usulan - Tolak";
            	let hasil   = (type === "terima") ? "Diterima" : "Ditolak";

            	Swal.fire({
                	title: title,
                	html: `
                    	<form id="formVerifikasi">
                        	<input type="hidden" name="action" value="\${type}">
                        	<input type="hidden" name="usulan_id" value="\${id}">
                        	<input type="hidden" name="user_id" value="\${user}">
                        	<div class="form-group text-left">
                            	<label>Catatan Admin</label>
                            	<textarea class="form-control" name="catatan" rows="3" placeholder="Tulis catatan verifikasi"></textarea>
                        	</div>
                    	</form>
                	`,
                	focusConfirm: false,
                	showCancelButton: true,
                	confirmButtonText: "Simpan",
                	cancelButtonText: "Batal",
                	preConfirm: () => {
                    	const form = document.getElementById("formVerifikasi");
                    	const formData = new FormData(form);

                    	return fetch("../../usulan/verifikasi.php", {
                        	method: "POST",
                        	body: formData
                    	})
                    	.then(response => response.json())
                    	.catch(error => {
                        	Swal.showValidationMessage(`Request gagal: \${error}`);
                    	});
                	}
            	}).then((result) => {
                	if (result.isConfirmed) {
                    	Swal.fire("Berhasil!", "Data berhasil diverifikasi.", "success")
                        	.then(() => location.reload());
                	}
            	});
        	});
    	});
	});
	</script>
HTML;
}
