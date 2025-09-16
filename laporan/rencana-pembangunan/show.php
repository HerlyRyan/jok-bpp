<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-primary"><?php echo $title ?></h1>
</div>

<!-- Filter Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
    </div>
    <div class="card-body">
        <form method="GET">
            <input type="hidden" name="page" value="laporanRencanaPembangunan">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">- Semua Tahun -</option>
                        <?php
                        $tahunSekarang = date('Y');
                        for ($i = $tahunSekarang; $i >= $tahunSekarang - 5; $i--) {
                            $selected = (isset($_GET['tahun']) && $_GET['tahun'] == $i) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="bidang">Bidang</label>
                    <select name="bidang" id="bidang" class="form-control">
                        <option value="">- Semua Bidang -</option>
                        <?php
                        $qBidang = mysqli_query($con, "SELECT * FROM bidang ORDER BY nama_bidang ASC");
                        while ($b = mysqli_fetch_assoc($qBidang)) {
                            $selected = (isset($_GET['bidang']) && $_GET['bidang'] == $b['bidang_id']) ? 'selected' : '';
                            echo "<option value='{$b['bidang_id']}' $selected>{$b['nama_bidang']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="periode">Periode</label>
                    <select name="periode" id="periode" class="form-control">
                        <option value="">- Semua Periode -</option>
                        <?php
                        for ($m = 1; $m <= 12; $m++) {
                            $namaBulan = date('F', mktime(0, 0, 0, $m, 10)); // Get month name
                            $selected = (isset($_GET['periode']) && $_GET['periode'] == $m) ? 'selected' : '';
                            echo "<option value='$m' $selected>$namaBulan</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-filter fa-sm"></i> Filter
                </button>
                <a href="?page=laporanRencanaPembangunan" class="btn btn-secondary mr-2">
                    <i class="fas fa-sync-alt fa-sm"></i> Reset
                </a>
                <?php
                // Build query string for print link
                $queryParams = $_GET;
                unset($queryParams['page']); // Remove page param for print script
                $queryString = http_build_query($queryParams);
                ?>
                <a href="../../laporan/rencana-pembangunan/print.php?<?php echo $queryString; ?>" target="_blank" class="btn btn-success">
                    <i class="fas fa-print fa-sm"></i> Cetak
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Data Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Data Rencana Pembangunan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Usulan</th>
                        <th>Program</th>
                        <th>Status Penetapan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Base query
                    $query = "SELECT 
                                rp.*,
                                u.judul AS usulan_judul,
                                b.nama_bidang AS nama_bidang,
                                p.nama_program AS nama_program
                            FROM rencana_pembangunan rp
                            JOIN usulan u  ON rp.usulan_id  = u.usulan_id
                            JOIN bidang b  ON u.bidang_id   = b.bidang_id
                            JOIN program p  ON u.program_id  = p.program_id
                            WHERE status_akhir = 'Ditetapkan'";

                    // Add filters
                    if (!empty($_GET['tahun'])) {
                        $tahun = intval($_GET['tahun']);
                        $query .= " AND rp.tahun = $tahun";
                    }
                    if (!empty($_GET['bidang'])) {
                        $bidang = intval($_GET['bidang']);
                        $query .= " AND b.bidang_id = $bidang";
                    }
                    if (!empty($_GET['periode'])) {
                        $periode = intval($_GET['periode']);
                        $query .= " AND rp.periode = $periode";
                    }

                    $result = mysqli_query($con, $query);
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars(ucfirst($data['usulan_judul'])); ?></td>
                            <td><?= htmlspecialchars(ucfirst($data['nama_program'])); ?></td>
                            <td><?= $data['status_akhir']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>