<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <?php 
                    $result = mysqli_query($con, "SELECT COUNT(id) AS total_return FROM tb_oxygen_return");
                    $row = mysqli_fetch_assoc($result); 
                    $sum = $row['total_return'];                             
                ?>
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                <h6 class="m-0">Total Oksigen Return: <b><?php echo $sum; ?></b></h6>                
            </div>
            <div class="card-body">                 
                <a class="btn btn-success" href="../laporan/printReturn.php" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
                <hr>
                
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataKategori" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Waktu Kembali</th>
                                <th>ID Oksigen</th>
                                <th>Serial Number</th>                              
                                <th>No DO</th>                                 
                                <th>Keterangan</th>                                                              
                            </tr>
                        </thead>
                        
                        <tbody>

                        <?php
                        $result = mysqli_query($con, "SELECT * FROM tb_oxygen_return");

                        $no = 1;
                        while ($data = mysqli_fetch_array($result)) {
                        ?>

                        <tr> 
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['return_date']; ?></td>
                            <td><?php echo $data['id_oxygen']; ?></td>
                            <td><?php echo $data['serial_number']; ?></td>                            
                            <td><?php echo $data['no_do']; ?></td>
                            <td><?php echo $data['keterangan']; ?></td>                            
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