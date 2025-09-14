<?php
session_start();
if (isset($_POST['submit'])) {
    $idOksigen = $_POST['idOksigen'];
    $tanggalKeluar = $_POST['exit_date'];
    $keterangan = $_POST['keterangan'];
    $serialNumber = $_POST['serialNumber'];
    $user = $_POST['user'];
    $status = $_POST['status'];

    if ($_SESSION['level'] == 0) {
        $insert = mysqli_query($con, "INSERT INTO tb_oxygen_exit(id_oxygen, keterangan, exit_date, status, user, serial_number) VALUES('$idOksigen', '$keterangan', '$tanggalKeluar', '$status', '$user', '$serialNumber')");
        if ($status == 'Accepted') {
            $dataOksigenStok = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_oxygen_stocks WHERE id_oxygen= '$idOksigen'"));
            $stok = $dataOksigenStok['stocks'];
            if ($stok > 0) {
                $updateEntry = mysqli_query($con, "UPDATE tb_oxygen_entry SET status = 'terpakai'  WHERE serial_number = '$serialNumber'");
                if ($insert && $updateEntry) {
                    $cekStok = mysqli_query($con, "SELECT COUNT(id_oxygen) as stocks FROM tb_oxygen_entry WHERE id_oxygen = '$idOksigen' AND status = 'tersedia'");
                    $stokOksigen = mysqli_fetch_array($cekStok);
                    $stokNow = $stokOksigen['stocks'];
                    mysqli_query($con, "UPDATE tb_oxygen_stocks SET stocks='$stokNow' WHERE id_oxygen=$idOksigen");
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
                            window.location.href = "?page=oksigenKeluar";
                        });
                        });
                        </script>
                    ';
                }
            } else {
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({                    
                        icon: "error",
                        title: "Out of stock...",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = "?page=oksigenKeluar";
                    });
                });
                </script>
            ';
            }
        } else {
            $updateEntry = mysqli_query($con, "UPDATE tb_oxygen_entry SET status = 'dipesan'  WHERE serial_number = '$serialNumber'");
            if ($updateEntry) {
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script type="text/javascript">
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({                    
                            icon: "success",
                            title: "Permintaan berhasil dikirim",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = "?page=oksigenKeluar";
                        });
                    });
                </script>
            ';
            }
        }
    } else {
        $nama = $_SESSION['username'];
        $insert = mysqli_query($con, "INSERT INTO tb_oxygen_exit(id_oxygen, keterangan, exit_date, status, user, serial_number) VALUES('$idOksigen', '$keterangan', '$tanggalKeluar', 'Pending', '$nama', '$serialNumber')");
        $updateEntry = mysqli_query($con, "UPDATE tb_oxygen_entry SET status = 'dipesan'  WHERE serial_number = '$serialNumber'");
        if ($insert && $updateEntry) {
            echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script type="text/javascript">
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({                    
                            icon: "success",
                            title: "Permintaan berhasil dikirim",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = "?page=oksigenKeluar";
                        });
                    });
                </script>
            ';
        }
    }
}

?>

<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php
                if ($_SESSION['level'] == 0) {
                ?>
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                <?php
                }
                ?>
                <?php
                if ($_SESSION['level'] > 0) {
                ?>
                    <h6 class="m-0 font-weight-bold text-primary">Permintaan Tabung</h6>
                <?php
                }
                ?>
            </div>
            <div class="card-body">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formBarangMasuk">
                    <i class="fas fa-plus"></i> Tambah
                </button>

                <hr>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="dataBarangMasuk" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Waktu Keluar</th>
                                <th>ID Oksigen</th>
                                <th>Serial Number</th>
                                <th>Keterangan</th>
                                <th>Peminta</th>
                                <th>Status</th>
                                <?php
                                if ($_SESSION['level'] == 0) {
                                ?>
                                    <th>Action</th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($_SESSION['level'] == 0) {
                                $result = mysqli_query($con, "SELECT * FROM tb_oxygen_exit");
                            } else if ($_SESSION['level'] > 0) {
                                $name = $_SESSION['username'];
                                $result = mysqli_query($con, "SELECT * FROM tb_oxygen_exit WHERE user = '$name'");
                            }
                            $no = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['exit_date'] ?></td>
                                    <td><?php echo $data['id_oxygen'] ?></td>
                                    <td><?php echo $data['serial_number'] ?></td>
                                    <td><?php echo $data['keterangan'] ?></td>
                                    <td><?php echo ucfirst($data['user']) ?></td>
                                    <td><span class="<?php
                                                        if ($data['status'] == 'Accepted') {
                                                            echo 'badge bg-success p-2 rounded text-light';
                                                        } else if ($data['status'] == 'Pending') {
                                                            echo 'badge bg-warning p-2 rounded text-light';
                                                        } else {
                                                            echo 'badge bg-danger p-2 rounded text-light';
                                                        }
                                                        ?>">
                                            <?php echo $data['status'] ?>
                                        </span>
                                    </td>
                                    <?php
                                    if ($_SESSION['level'] == 0) {
                                    ?>
                                        <?php
                                        if ($data['status'] == 'Accepted' || $data['status'] == 'Rejected') {
                                        ?>
                                            <td>
                                                <a data-toggle="tooltip" data-placement="top" title="hapus data" class="btn btn-sm btn-circle btn-danger" onclick="deleteData(<?php echo $data['id']; ?>)"><i class="fa fa-trash"></i></a>
                                            </td>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($data['status'] == 'Pending') {
                                        ?>
                                            <td>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="accepted" class="btn btn-sm btn-circle btn-success" onclick="accepted(<?php echo $data['id']; ?>)"><i class="fa fa-check"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="rejected" class="btn btn-sm btn-circle btn-danger" onclick="rejected(<?php echo $data['id']; ?>)"><b>X</b></a>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                </tr>
                            <?php
                                    }
                            ?>
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

<div class="modal fade" id="formBarangMasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="idOksigen">ID Oksigen</label>

                        <select name="idOksigen" class="form-control" id="idOksigen" required onchange="updateSelected()">
                            <option value="-" selected>- Pilih ID Oksigen -</option>
                            <?php
                            include "connection.php";
                            $query = mysqli_query($con, "SELECT * FROM tb_oxygen_data ORDER BY id_oxygen ASC");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?= $data['id_oxygen'] ?>"><?= $data['id_oxygen'] ?> - <?php echo $data['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="serialNumber">Serial Number</label>
                        <select name="serialNumber" class="form-control" id="serialNumber" required>
                            <option value="-" selected>- Pilih Serial Number -</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Ket.....">
                    </div>

                    <div class="form-group">
                        <label for="exit_date">Tanggal Keluar</label>
                        <input type="date" name="exit_date" class="form-control" placeholder="">
                    </div>

                    <?php
                    if ($_SESSION['level'] == 0) {
                    ?>
                        <div class="form-group">
                            <label for="status">Status</label>

                            <select name="status" class="form-control" id="status" required>
                                <option value="-" selected>- Pilih Status -</option>
                                <option value="Pending">Pending</option>
                                <option value="Accepted">Accepted</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user">Peminta</label>

                            <select name="user" class="form-control" id="user" required>
                                <option value="-" selected>- Pilih Peminta -</option>
                                <?php
                                include "connection.php";
                                $query = mysqli_query($con, "SELECT * FROM user WHERE level = 1");
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?= ($data['username']) ?>"><?= (ucfirst($data['username'])) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    <?php
                    }
                    ?>

                    <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function deleteData(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?page=oksigenKeluarDelete&id=" + id;
            }
        })
    }

    function accepted(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Cek ke ugentan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Terima',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `?page=oksigenKeluarAccepted&id=${id}`;
            }
        })
    }

    function rejected(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Cek ke ugentan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tolak',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?page=oksigenKeluarRejected&id=" + id;
            }
        })
    }

    function updateSelected() {
        const idOksigen = document.getElementById('idOksigen').value;

        updateSerialNumberJS(idOksigen)
    }

    function updateSerialNumberJS(idOksigen) {
        const optionSerialNumber = document.getElementById('serialNumber')
        // console.log(idOksigen)

        if (idOksigen == '00006171') {
            optionSerialNumber.innerHTML = `
                <option value="-" selected>- Pilih Serial Number -</option>
                <?php
                include "connection.php";
                $query = mysqli_query($con, "SELECT * FROM tb_oxygen_entry WHERE id_oxygen = '00006171'");
                while ($data = mysqli_fetch_array($query)) {
                    if ($data['status'] == 'tersedia') {
                        $serialNumbers = $data['serial_number'];
                        echo "<option value='$serialNumbers'>$serialNumbers</option>";
                    }
                }
                ?>
            `
        } else if (idOksigen == '00006172') {
            optionSerialNumber.innerHTML = `
                <option value="-" selected>- Pilih Serial Number -</option>
                <?php
                include "connection.php";
                $query = mysqli_query($con, "SELECT * FROM tb_oxygen_entry WHERE id_oxygen = '00006172'");
                while ($data = mysqli_fetch_array($query)) {
                    if ($data['status'] == 'tersedia') {
                        $serialNumbers = $data['serial_number'];
                        echo "<option value='$serialNumbers'>$serialNumbers</option>";
                    }
                }
                ?>
            `
        }
    }
</script>