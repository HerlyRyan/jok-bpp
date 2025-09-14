<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Kateogori</title>
    <style>

        * {
            font-family: arial;
        }
        
        table {
            border-collapse: collapse;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1 align="center">Laporan Data Kategori</h1>
    <p align="center"><?=  date("Y/m/d") ?></p>
    <table border="1" width="100%" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        
        <tbody>

        <?php
        include '../connection.php';
        $result = mysqli_query($con, "SELECT * FROM kategori");

        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>

        <tr>   
            <td width="30" align="center"><?= $no++ ?></td> 
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['keterangan']; ?></td>
        </tr>
        <?php
        }
        ?>
        
        </tbody>
    </table>
    <br><br>
    <table width="100%">
        <tbody>
        <tr>
            <td width="50%" align="center">
                <p>Pegawai</p>
                <br><br><br>
                <p><strong>Nama Pegawai</strong></p>
            </td>
            <td width="50%" align="center">
                <p>Manager</p>
                <br><br><br>
                <p><strong>Nama Manager</strong></p>

            </td>
        </tr>
        </tbody>
    </table>
    
    <script>
        window.print();
    </script>
    
</body>
</html>