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

<style></style>