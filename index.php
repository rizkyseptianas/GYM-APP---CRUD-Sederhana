<?php
include "config/koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php");
    exit;
}

include "layout.php"; 

$totalMember = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM members"));
?>

    <!-- Particles Background -->
    <div id="particles-js"></div>

    <div class="container mt-5 position-relative">

    <!-- Logo / Header -->
    <div class="text-center mb-5">
        <img src="assets/img/logoo.png" alt="Logo" style="width:210px;" class="animate__animated animate__fadeInDown">
        <h2 class="mt-3 animate__animated animate__fadeInUp">Dashboard Admin</h2>
    </div>

    <!-- System Info -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="glass p-4 text-center animate__animated animate__zoomIn">
                <div class="row">
                    <div class="col-md-4">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h5>Waktu</h5>
                        <div id="current-time" class="h4">--:--:--</div>
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-calendar fa-2x mb-2"></i>
                        <h5>Tanggal</h5>
                        <div id="current-date" class="h4">--/--/--</div>
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-server fa-2x mb-2"></i>
                        <h5>Status Sistem</h5>
                        <div class="h4 text-success">Online</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 animate__animated animate__fadeInUp">

        <!-- Total Member -->
        <div class="col-md-4">
            <div class="glass text-center p-4">
                <i class="fas fa-users fa-3x mb-3"></i>
                <h4>Total Member</h4>
                <h1><?= $totalMember ?></h1>
            </div>
        </div>

        <!-- Kelola Member -->
        <div class="col-md-4">
            <div class="glass text-center p-4">
                <i class="fas fa-user-cog fa-3x mb-3"></i>
                <h4>Kelola Member</h4>
                <a href="members/index.php" class="btn btn-primary btn-hover">Masuk</a>
            </div>
        </div>

        <!-- Report -->
        <div class="col-md-4">
            <div class="glass text-center p-4">
                <i class="fas fa-file-alt fa-3x mb-3"></i>
                <h4>Report</h4>
                <a href="report/print.php" class="btn btn-success btn-hover">Print</a>
            </div>
        </div>

    </div>
</div>


