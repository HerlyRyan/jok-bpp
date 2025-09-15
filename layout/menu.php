<style>
    .active {
        border-left: 5px solid white;
    }
</style>

<?php
session_start();
?>

<?php
if ($_SESSION['status'] == 'login') {
?>
    <ul class="navbar-nav bg-gradient-primary  sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <!-- <img src="../assets/img/logo-dsp.png" alt="" class="img-responsive" width="75" height="50"> -->
            </div>
            <div class="sidebar-brand-text mx-3 text-left">E-Planning</div>
        </a>
        <hr class="sidebar-divider my-0">
        <?php
        if ($_SESSION['role'] == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'dashboard' ? 'active' : '' ?>" href="?page=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'usulan' ? 'active' : '' ?>" href="?page=usulan">
                    <i class="fas fa-fw fa-clipboard-check"></i>
                    <span>Verifikasi Usulan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'oksigenMasuk' ? 'active' : '' ?>" href="?page=oksigenMasuk">
                    <i class="fas fa-fw fa-bullseye"></i>
                    <span>Penetapan Rencana</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'oksigenKeluar' ? 'active' : '' ?>" href="?page=oksigenKeluar">
                    <i class="fas fa-fw fa-bullhorn"></i>
                    <span>Pengaduan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'master' ? 'active' : '' ?>" href="?page=master">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Master Data</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed <?= $_GET['page'] == 'stok' || $_GET['page'] == 'trackingSerialNumber' || $_GET['page'] == 'laporanMasuk' || $_GET['page'] == 'laporanKeluar' || $_GET['page'] == 'laporanReturn' || $_GET['page'] == 'laporanPemakaianTabung' || $_GET['page'] == 'laporanPemakaianDivisi' ? 'active' : '' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?page=laporanMasuk">Tabung Masuk</a>
                        <a class="collapse-item" href="?page=laporanKeluar">Tabung Keluar</a>
                        <a class="collapse-item" href="?page=laporanReturn">Tabung Return</a>
                        <a class="collapse-item" href="?page=stok">Stok Tabung</a>
                        <a class="collapse-item" href="?page=trackingSerialNumber">Serial Number</a>
                        <a class="collapse-item" href="?page=laporanPemakaianTabung">Pemakaian Tabung</a>
                        <a class="collapse-item" href="?page=laporanPemakaianDivisi">Pemakaian Divisi</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'user' ? 'active' : '' ?>" href="?page=user">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User</span></a>
            </li>
        <?php
        }
        ?>
        <?php if ($_SESSION['role'] == 'user_desa') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'dashboard' ? 'active' : '' ?>" href="?page=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'usulanAdd' ? 'active' : '' ?>" href="?page=usulanAdd">
                    <i class="fas fa-fw fa-paper-plane"></i>
                    <span>Usulan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'oksigenKeluar' ? 'active' : '' ?>" href="?page=oksigenKeluar">
                    <i class="fas fa-fw fa-bullhorn"></i>
                    <span>Pengaduan</span>
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['role'] == 'pimpinan') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?= $_GET['page'] == 'dashboard' ? 'active' : '' ?>" href="?page=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed <?= $_GET['page'] == 'stok' || $_GET['page'] == 'trackingSerialNumber' || $_GET['page'] == 'laporanMasuk' || $_GET['page'] == 'laporanKeluar' || $_GET['page'] == 'laporanReturn' || $_GET['page'] == 'laporanPemakaianTabung' || $_GET['page'] == 'laporanPemakaianDivisi' ? 'active' : '' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?page=laporanMasuk">Tabung Masuk</a>
                        <a class="collapse-item" href="?page=laporanKeluar">Tabung Keluar</a>
                        <a class="collapse-item" href="?page=laporanReturn">Tabung Return</a>
                        <a class="collapse-item" href="?page=stok">Stok Tabung</a>
                        <a class="collapse-item" href="?page=trackingSerialNumber">Serial Number</a>
                        <a class="collapse-item" href="?page=laporanPemakaianTabung">Pemakaian Tabung</a>
                        <a class="collapse-item" href="?page=laporanPemakaianDivisi">Pemakaian Divisi</a>
                    </div>
                </div>
            </li>
        <?php } ?>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Logout -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-fw"></i>
                <span>Logout</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
<?php
}
?>