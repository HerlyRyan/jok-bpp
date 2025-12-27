<style>
    .isi-pengaduan {
        max-width: 300px;
        /* atur sesuai kebutuhan */
        white-space: normal;
        /* izinkan turun baris */
        word-wrap: break-word;
        word-break: break-word;
    }
</style>

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
                        <th>Pengirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Base query
                    $query = "SELECT 
                            pengaduan.pengaduan_id,
                            pengaduan.judul,
                            pengaduan.isi_pengaduan,
                            pengaduan.tanggal_pengaduan,
                            users.username as name 
                        FROM 
                            pengaduan
                        JOIN
                            users
                        ON
                            users.user_id = pengaduan.user_id 
                        WHERE 
                            status = 'Masuk'";

                    $result = mysqli_query($con, $query);
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars(ucfirst($data['judul'])); ?></td>
                            <td class="text-wrap isi-pengaduan"><?= substr(htmlspecialchars($row['isi_pengaduan']), 0, 80) ?>...
                                <a href="#" data-bs-toggle="modal" data-bs-target="#detail<?= $data['pengaduan_id'] ?>">
                                    Detail
                                </a>
                            </td>
                            <td><?= $data['tanggal_pengaduan']; ?></td>
                            <td><?= htmlspecialchars(ucfirst($data['name'])); ?></td>
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

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detail<?= $data['pengaduan_id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Isi Pengaduan</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?= nl2br(htmlspecialchars($data['isi_pengaduan'])) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>