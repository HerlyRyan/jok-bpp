<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <?php 
                    $result = mysqli_query($con, "SELECT COUNT(id) AS total_masuk FROM tb_oxygen_entry");
                    $row = mysqli_fetch_assoc($result); 
                    $sum = $row['total_masuk'];                             
                ?>
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                <h6 class="m-0">Total Oksigen Masuk: <b><?php echo $sum; ?></b></h6>
            </div>
            <div class="card-body">                
                <a href="../laporan/printMasuk.php" class="btn btn-success" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
                <hr>
                
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataBarangMasuk" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Waktu Masuk</th>
                                <th>ID Oksigen</th> 
                                <th>Keterangan</th>     
                                <th>Serial Number</th>                                         
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            $no = 1;
                            $result = mysqli_query($con, "SELECT * FROM tb_oxygen_entry");
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                            <tr> 
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['entry_date'] ?></td>
                                <td><?php echo $data['id_oxygen'] ?></td>                                
                                <td><?php echo $data['keterangan'] ?></td>                                
                                <td><?php echo $data['serial_number'] ?></td>                                
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