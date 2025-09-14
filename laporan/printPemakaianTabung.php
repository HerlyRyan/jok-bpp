<?php
include_once '../function.php';
include_once '../connection.php';

$query = chartTabung($con);

$dataName = array();
$dataPemakaian = array();
while ($data = mysqli_fetch_array($query)) {
    $dataName[] = $data['NAME'];
    $dataPemakaian[] = $data['pemakaian'];
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const label = <?php echo json_encode($dataName); ?>;
            const dataPemakaian = <?php echo json_encode($dataPemakaian); ?>;
            const data1 = {
                labels: label,
                datasets: [{
                    label: ' pemakaian',
                    data: dataPemakaian,
                    backgroundColor: [
                        'rgb(12, 108, 173)',
                        'rgb(54, 162, 235)',
                    ],
                    hoverOffset: 4
                }]
            };
            // console.log(data1)
            var ctx = document.getElementById('myChart').getContext('2d');
            // console.log(ctx)

            // <!-- render block -->
            const render = new Chart(
                ctx, {
                    type: 'pie',
                    data: data1,
                }
            );
        })
    </script>
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

        .row {
            display: flex;
            /* flex-direction: column; */
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            width: 100%;
        }

        .chart {
            width: 300px;
        }
    </style>
</head>

<body>
    <header>
        <img src="../assets/img/logo-dsp.png" alt="" width="90" height="70">
        <div class="text-header">
            <h4 align="center">Laporan Data Tabung Return</h4>
            <p><?= tgl_indo(date('Y-m-d')) ?></p>
        </div>
    </header>
    <hr>
    <div class="row">
        <div class="col-1">
            <canvas id="myChart" class="chart"></canvas>
        </div>
        <table border="1" width="100%" cellpadding="5">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>ID Tabung</th>
                    <th>Nama Tabung</th>
                    <th>Pemakaian</th>
                </tr>
            </thead>

            <tbody align="center">
                <?php
                $no = 1;
                $query = chartTabung($con);
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo ucfirst($data['id_oxygen']) ?></td>
                        <td><?php echo ucfirst($data['NAME']) ?></td>
                        <td><?php echo $data['pemakaian'] ?> Tabung</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

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

    <!-- <script>
        window.print();
    </script> -->

</body>

</html>