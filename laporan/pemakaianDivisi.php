<?php
$query = chartDivisi($con);

$dataName = array();
$dataPemakaian = array();
while ($data = mysqli_fetch_array($query)) {
    $dataName[] = $data['username'];
    $dataPemakaian[] = $data['pemakaian'];
};

?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const label = <?php echo json_encode($dataName); ?>;
        const dataPemakaian = <?php echo json_encode($dataPemakaian); ?>;
        const data1 = {
            labels: label,
            datasets: [{
                label: ' pemakaian divisi',
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
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
            </div>
            <div class="card-body">
                <a href="../laporan/printPemakaianDiv.php" class="btn btn-success" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                    <div class="col">
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered table-hover" id="dataBarangMasuk" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Divisi</th>
                                        <th>Pemakaian</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query = chartDivisi($con);
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo ucfirst($data['username']) ?></td>
                                            <td><?php echo $data['pemakaian'] ?> Tabung</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>