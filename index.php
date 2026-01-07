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

<div class="container mt-5">

    <!-- Logo / Header -->
    <div class="text-center mb-5">
        <img src="assets/img/logoo.png" alt="Logo" style="width:210px;">
        <h2 class="mt-3">Dashboard Admin</h2>
    </div>

    <div class="row g-4">

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

<style>
/* Glass card modern */
.glass {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(15px);
    border-radius: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
.glass:hover {
    transform: translateY(-7px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.35);
}

/* Tombol modern */
.btn-hover {
    transition: all 0.3s ease;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: bold;
}
.btn-hover:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

/* Gradien untuk tombol */
.btn-primary { background: linear-gradient(45deg,#007bff,#00c6ff); border:none; color:#fff;}
.btn-success { background: linear-gradient(45deg,#28a745,#85e085); border:none; color:#fff;}

/* Ikon card */
i { color:#fff; }
</style>

<!-- Link FontAwesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
