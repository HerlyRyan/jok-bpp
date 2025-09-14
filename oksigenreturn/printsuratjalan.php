<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Jalan</title>
    <style>
        * {
            font-family: sans-serif;
            margin: 0;
            padding: 0;            
        }

        body {
            margin: 50px;
        }              
        
        table {
            font-size: 1rem;
        }

        th, td {
            padding: 0.5rem;
        }

    </style>
</head>
<body>
    <header style="font-size: 1rem;">
        <h1>PT DUA SAMUDERA PERKASA</h1>
        <p>PORT SEI DUA</p>
    </header>
    <h2 align="center" style="text-decoration: underline; margin: 20px 0;">SURAT JALAN</h2>
    <div style="display: flex; flex-direction: column; gap: 5px; margin: 10px 0;">
        <pre>Diserahkan Kepada : </pre>
        <pre>Nama                    : </pre>
        <pre>Alamat                  : </pre>
    </div>
    <table border="1" width="100%" cellpadding="5" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tabung</th>
                <th>Serial Number</th>
                <th>Keterangan</th>                
            </tr>
        </thead>
        <tbody align="center">
        <?php
            include '../connection.php';        
            $currentDate = date('Y-m-d');
            $result = mysqli_query($con, "SELECT * FROM tb_oxygen_return WHERE DATE(return_date) = '$currentDate'");
            $banyak = mysqli_num_rows($result);
            $no = 1;
            while ($dataReturn = mysqli_fetch_array($result)) {
                $idOksigen = $dataReturn['id_oxygen'];
                $queryTabung = mysqli_query($con, "SELECT * FROM tb_oxygen_data WHERE id_oxygen = '$idOksigen'");
                $dataTabung = mysqli_fetch_array($queryTabung);
                $namaTabung = $dataTabung['name'];                
            ?>
                <tr>   
                    <td width="30" align="center"><?= $no++ ?></td> 
                    <td><?php echo $namaTabung; ?></td>            
                    <td><?php echo $dataReturn['serial_number']; ?></td>
                    <td><?php echo $dataReturn['keterangan']; ?></td>
                </tr>
            <?php
            }
            ?>  
        </tbody>
        <tfoot align="center">
            <tr>
                <td colspan="3"><b>Total</b></td>
                <td><b><?php echo $banyak; ?></b></td>
            </tr>
            <tr>
                <td colspan="4"><b>Harap diperiksa sebelum dibongkar</b></td>
            </tr>
        </tfoot>
    </table>    
    <table align="right">
        <tbody>
            <tr>
                <td style="font-size: 1rem;">Batulicin, <?php echo date('d F Y'); ?></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table width="100%" align="center">
        <tbody>
        <tr style="display: flex;">
            <td align="center" style="width: 60%; text-align:left; margin-left: 20px">
                <p style="margin-left: 20px;">Yang Menerima,</p>
                <br><br><br><br><br>
                <p><strong>(...................................)</strong></p>
            </td>
            <td align="center" style="width: 20%;">
                <p>Yang Membawa,</p>
                <br><br><br><br><br>
                <p><strong>(...................................)</strong></p>
            </td>
            <td align="center" style="width: 20%;">
                <p>Yang Menyerahkan,</p>
                <br><br><br><br><br>
                <p><strong>(...................................)</strong></p>
            </td>
        </tr>
        </tbody>
    </table>
    
    <!-- <script>
        window.print();
    </script> -->
    
</body>
</html>
