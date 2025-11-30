<?php
include '../../connection.php';

// Ambil filter dari query string
$tahun   = isset($_GET['tahun']) ? intval($_GET['tahun']) : '';
$bidang  = isset($_GET['bidang']) ? intval($_GET['bidang']) : '';
$periode = isset($_GET['periode']) ? intval($_GET['periode']) : '';

// Base query
$query = "SELECT 
                u.usulan_id,
                u.judul AS nama_kegiatan,
                b.nama_bidang AS bidang,
                v.hasil AS status,
                u.status_penetapan AS keterangan,
                v.catatan
            FROM verifikasi v
            JOIN usulan u ON v.usulan_id = u.usulan_id
            JOIN bidang b ON u.bidang_id = b.bidang_id
        ";

// Add filters
if (!empty($_GET['tahun'])) {
    $tahun = intval($_GET['tahun']);
    $query .= " WHERE YEAR(v.tanggal) = $tahun";
}
if (!empty($_GET['bidang'])) {
    $bidang = intval($_GET['bidang']);
    $query .= " AND b.bidang_id = $bidang";
}
if (!empty($_GET['periode'])) {
    $periode = intval($_GET['periode']);
    $query .= " AND MONTH(v.tanggal) = $periode";
}

$query .= " ORDER BY v.tanggal DESC;";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Status Usulan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3,
        .header p {
            margin: 0;
            padding: 2px;
        }

        .logo {
            float: left;
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .logo img {
            width: 100%;
            height: auto;
        }

        .judul-laporan {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            text-decoration: underline;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        .ttd {
            width: 250px;
            float: right;
            text-align: center;
        }

        .clearfix {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <div class="logo">
            <img src="../../assets/img/logo-bapperida-pulang-pisau.jpg" alt="Logo Bapperida">
        </div>
        <h2>PEMERINTAH KABUPATEN PULANG PISAU</h2>
        <h3>DINAS PERENCANAAN PEMBANGUNAN DAERAH (BAPPEDA)</h3>
        <p>Jl. Mentaren I, Kec. Kahayan Hilir, Kab. Pulang Pisau, Kalimantan Tengah</p>
        <p>Telp: xxxxxxxxxx Fax: xxxxxxxxxx</p>
        <div class="clearfix"></div>
        <hr>
    </div>

    <div class="judul-laporan">Laporan Rekap Status Usulan</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Usulan</th>
                <th>Bidang</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>" . htmlspecialchars(ucfirst($data['nama_kegiatan'])) . "</td>
                        <td>" . htmlspecialchars(ucfirst($data['bidang'])) . "</td>
                        <td>{$data['status']}</td>
                        <td>{$data['keterangan']}</td>
                        <td>{$data['catatan']}</td>
                      </tr>";
                $no++;
            }
            if ($no == 1) {
                echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="ttd">
        Pulang Pisau, ...... Juni 2025 <br>
        Kepala Dinas Bappeda <br><br><br><br>
        (__________________)
    </div>

</body>

</html>