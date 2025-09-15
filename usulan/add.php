<?php
if (isset($_POST['submit'])) {
    $user_id         = $_POST['user_id'];
    $bidang_id       = $_POST['bidang_id'];
    $satuan_id       = $_POST['satuan_id'];
    $program_id      = $_POST['program_id'];
    $usulan          = $_POST['usulan'];
    $volume          = $_POST['volume'];

    $query = mysqli_query($con, "SELECT * FROM tb_oxygen_stocks WHERE id_oxygen = '$idOksigen'");
    $dataTabung = mysqli_fetch_array($query);
    $idData = $dataTabung['id_oxygen'];


    $result = mysqli_query($con, "INSERT INTO tb_oxygen_data(id_oxygen, name) VALUES('$idOksigen','$name')");
    if ($result) {
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({                    
                    icon: "success",
                    title: "Data berhasil disimpan",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=master";
                });
            });
            </script>
            ';
    } else {
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    
                    icon: "error",
                    title: "ID sudah ada",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "?page=master";
                });
            });
            </script>
        ';
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="bidang_id" class="col-sm-2 col-form-label">Bidang</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="bidang_id" required>
                                    <option value="">-- Pilih Bidang --</option>
                                    <?php
                                    // Contoh query untuk mengambil data bidang
                                    // $queryBidang = mysqli_query($con, "SELECT * FROM tb_bidang");
                                    // while($data = mysqli_fetch_array($queryBidang)){
                                    //     echo '<option value="'.$data['id_bidang'].'">'.$data['nama_bidang'].'</option>';
                                    // }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="program_id" class="col-sm-2 col-form-label">Program</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="program_id" required>
                                    <option value="">-- Pilih Program --</option>
                                    <?php
                                    // Contoh query untuk mengambil data program
                                    // $queryProgram = mysqli_query($con, "SELECT * FROM tb_program");
                                    // while($data = mysqli_fetch_array($queryProgram)){
                                    //     echo '<option value="'.$data['id_program'].'">'.$data['nama_program'].'</option>';
                                    // }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="usulan" class="col-sm-4 col-form-label">Nama Kegiatan</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="usulan" placeholder="Masukan Uraian Usulan..." required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="volume" class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="volume" placeholder="Masukan Volume..." required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="program_id" class="col-sm-4 col-form-label">Satuan</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="satuan_id" required>
                                    <option value="">-- Pilih Satuan --</option>
                                    <?php
                                    // Contoh query untuk mengambil data satuan
                                    // $querySatuan = mysqli_query($con, "SELECT * FROM tb_satuan");
                                    // while($data = mysqli_fetch_array($querySatuan)){
                                    //     echo '<option value="'.$data['id_satuan'].'">'.$data['nama_satuan'].'</option>';
                                    // }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col offset-md-0">
                            <div class="col-sm-12">
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim Usulan</button>
                                <a href="?page=dashboard" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>