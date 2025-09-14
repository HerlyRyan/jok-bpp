<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data</title>
    <style>
        * {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            padding: 0;
            margin: 0;
        }

        body {
            padding: 1.2rem;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .text-header {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .text-header>p {
            font-size: 0.8rem;
        }

        hr {
            border: 2px solid black;
            margin: 1rem auto;
        }

        table {
            border-collapse: collapse;
            font-size: 0.8rem;
        }

        thead {
            background-color: rgb(31, 117, 215);
            color: white;
        }

        thead>tr>th {
            padding: 8px;
        }

        tbody>tr>td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    include_once '../function.php';
    ?>
    <header>
        <img src="../assets/img/logo-dsp.png" alt="" width="90" height="70">
        <div class="text-header">
            <h4 align="center">Laporan Data Serial Number</h4>
            <p><?= tgl_indo(date('Y-m-d')) ?></p>
        </div>
    </header>
    <hr>
    <table border="1" width="100%" cellpadding="5">
        <thead>
            <tr class="text-center">
                <th>ID Oksigen </th>
                <th>Nama</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Tanggal Return</th>
                <th>Serial Number</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            <?php
            include '../connection.php';
            $result = mysqli_query($con, "
                SELECT 
                    e.id_oxygen, 
                    d.name AS name, 
                    e.entry_date, 
                    ex.exit_date, 
                    r.return_date, 
                    e.serial_number, 
                    e.status
                FROM tb_oxygen_entry e
                LEFT JOIN tb_oxygen_data d ON d.id_oxygen = e.id_oxygen
                LEFT JOIN tb_oxygen_exit ex ON ex.serial_number = e.serial_number
                LEFT JOIN tb_oxygen_return r ON r.serial_number = e.serial_number
            ");

            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>

                <tr align="center">
                    <td><?php echo $data['id_oxygen']; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?= $data['entry_date'] ? tgl($data['entry_date']) : '-' ?></td>
                    <td><?= $data['exit_date'] ? tgl($data['exit_date']) : '-' ?></td>
                    <td><?= $data['return_date'] ? tgl($data['return_date']) : '-' ?></td>
                    <td><?php echo $data['serial_number']; ?></td>
                    <td><?php echo strtoupper($data['status']); ?></td>
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
                    <p>Admin</p>
                    <br><br><br>
                    <p><strong>Gita</strong></p>
                </td>
                <td width="50%" align="center">
                    <p>Supervisor</p>
                    <br><br><br>
                    <p><strong>Sigit Triwibowo</strong></p>
                </td>
            </tr>
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>