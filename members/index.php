<?php
include "../config/koneksi.php";
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['login'])) header("Location: ../auth/login.php");

include "../layout.php";

$alert = "";
if(isset($_GET['msg'])){
    if($_GET['msg'] == "hapus") $alert = '<div class="alert alert-success">Data berhasil dihapus!</div>';
}

$data = mysqli_query($conn,"SELECT * FROM members ORDER BY created_at DESC");
?>

<div class="container">
    <div class="glass p-4">
        <h3>Data Member</h3>

        <!-- Alert -->
        <?= $alert ?>

        <a href="tambah.php" class="btn btn-primary mb-3 btn-hover">+ Tambah Member</a>

        <table class="table table-dark table-hover table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Paket</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while($r=mysqli_fetch_assoc($data)){ ?>
                <tr>
                    <td><?= htmlspecialchars($r['nama']) ?></td>
                    <td><?= $r['umur'] ?></td>
                    <td><?= $r['paket'] ?></td>
                    <td><?= ucfirst($r['status_member']) ?></td>
                    <td><?= date("d M Y", strtotime($r['tanggal_daftar'])) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-sm btn-hover">Edit</a>
                        <a href="hapus.php?id=<?= $r['id'] ?>" class="btn btn-danger btn-sm btn-hover" onclick="return confirm('Hapus data member ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Efek umum tombol */
.btn-hover {
    transition: all 0.3s ease;
    border-radius: 8px;
    font-weight: 500;
}

/* Hover efek */
.btn-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
}

/* Tombol Primary */
.btn-primary.btn-hover:hover {
    background-color: #0d6efd;
    box-shadow: 0 0 12px rgba(13, 110, 253, 0.8);
}

/* Tombol Warning (Edit) */
.btn-warning.btn-hover:hover {
    background-color: #ffc107;
    color: #000;
    box-shadow: 0 0 12px rgba(255, 193, 7, 0.8);
}

/* Tombol Danger (Hapus) */
.btn-danger.btn-hover:hover {
    background-color: #dc3545;
    box-shadow: 0 0 12px rgba(220, 53, 69, 0.8);
}

/* Animasi klik */
.btn-hover:active {
    transform: scale(0.95);
}

</style>