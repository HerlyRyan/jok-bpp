<?php
include '../../connection.php';

// Ambil filter dari query string
$tahun   = isset($_GET['tahun']) ? intval($_GET['tahun']) : '';
$bidang  = isset($_GET['bidang']) ? intval($_GET['bidang']) : '';
$periode = isset($_GET['periode']) ? intval($_GET['periode']) : '';

// Base query
$query = "SELECT usulan.*, bidang.nama_bidang, program.nama_program 
          FROM usulan 
          JOIN bidang ON usulan.bidang_id = bidang.bidang_id 
          JOIN program ON usulan.program_id = program.program_id 
          WHERE status_penetapan = 'Masuk'";

// Filter tambahan
if (!empty($tahun)) {
    $query .= " AND tahun = $tahun";
}
if (!empty($bidang)) {
    $query .= " AND bidang.bidang_id = $bidang";
}
if (!empty($periode)) {
    $query .= " AND MONTH(tanggal) = $periode";
}

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Usulan Masuk</title>
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
            border: 1px solid #000;
            margin-right: 15px;
            text-align: center;
            line-height: 80px;
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
        <div class="logo">LOGO</div>
        <h2>PEMERINTAH KABUPATEN PULANG PISAU</h2>
        <h3>DINAS PERENCANAAN PEMBANGUNAN DAERAH (BAPPEDA)</h3>
        <p>Jl. Mentaren I, Kec. Kahayan Hilir, Kab. Pulang Pisau, Kalimantan Tengah</p>
        <p>Telp: xxxxxxxxxx Fax: xxxxxxxxxx</p>
        <div class="clearfix"></div>
        <hr>
    </div>

    <div class="judul-laporan">Laporan Usulan Masuk</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Usulan</th>
                <th>Bidang</th>
                <th>Program</th>
                <th>Volume</th>
                <th>Status Usulan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>" . htmlspecialchars(ucfirst($data['judul'])) . "</td>
                        <td>" . htmlspecialchars(ucfirst($data['nama_bidang'])) . "</td>
                        <td>" . htmlspecialchars(ucfirst($data['nama_program'])) . "</td>
                        <td>" . htmlspecialchars(ucfirst($data['volume'])) . "</td>
                        <td>{$data['status_penetapan']}</td>
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