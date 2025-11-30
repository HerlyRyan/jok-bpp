<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-primary"><?php echo $title ?></h1>
</div>

<!-- Data Table Card -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>                        
                        <th>Judul Pengaduan</th>
                        <th>Isi Pengaduan</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Base query
                    $query = "SELECT * FROM pengaduan WHERE status = 'Masuk'";

                    $result = mysqli_query($con, $query);
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>                            
                            <td><?= htmlspecialchars(ucfirst($data['judul'])); ?></td>
                            <td><?= htmlspecialchars(ucfirst($data['isi_pengaduan'])); ?></td>
                            <td><?= $data['tanggal_pengaduan']; ?></td>
                            <!-- <td><?php
                                $status = $data['status'];
                                $badge_class = '';
                                if ($status == 'Masuk') {
                                    $badge_class = 'badge-warning'; // Kuning untuk status 'Masuk' (Pending)
                                } elseif ($status == 'Ditetapkan') {
                                    $badge_class = 'badge-success'; // Hijau untuk 'Ditetapkan' (Diterima)
                                } else {
                                    $badge_class = 'badge-secondary'; // Default
                                }
                                ?>
                                <span class="badge <?php echo $badge_class; ?> text-uppercase"><?php echo $status; ?></span>
                            </td> -->
                            <td>
                                <a data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm btn-action" href="#" data-type="tetapkan" data-url="?page=tetapkanPengaduan&id=<?php echo $data['pengaduan_id']; ?>"><i class="fa fa-check fa-sm"></i> Tetapkan</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>