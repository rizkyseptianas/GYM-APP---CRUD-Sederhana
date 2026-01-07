<?php
include "../config/koneksi.php";
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['login'])) header("Location: ../auth/login.php");

$showModal = false;
$modalTitle = "";
$modalMessage = "";
$modalType = "";

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $paket = $_POST['paket'];
    $status_member = $_POST['status_member'];
    $umur = date_diff(date_create($tanggal_lahir), date_create('today'))->y;

    $insert = mysqli_query($conn,"INSERT INTO members (nama,tanggal_lahir,umur,paket,status_member) 
                                  VALUES ('$nama','$tanggal_lahir','$umur','$paket','$status_member')");
    if($insert){
        header("Location: index.php?msg=success");
        exit;
    } else {
        $showModal = true;
        $modalTitle = "Error!";
        $modalMessage = "Gagal menambahkan member: " . mysqli_error($conn);
        $modalType = "danger";
    }
}

include "../layout.php";
?>

<div class="container col-md-6">
    <div class="glass p-4">
        <h3>Tambah Member</h3>
        <form method="POST">
            <input type="text" class="form-control mb-3" name="nama" placeholder="Nama Member" required>
            <input type="date" class="form-control mb-3" name="tanggal_lahir" required>
            <select name="paket" class="form-control mb-3">
                <option value="Reguler">Reguler</option>
                <option value="Premium">Premium</option>
                <option value="VIP">VIP</option>
            </select>
            <select name="status_member" class="form-control mb-3">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
            <button type="submit" name="submit" class="btn btn-success btn-hover">Tambah</button>
            <a href="index.php" class="btn btn-danger btn-hover">Batal</a>
        </form>
    </div>
</div>

<!-- Modal Error -->
<?php if($showModal): ?>
<div class="modal-overlay">
    <div class="modal-content <?= $modalType ?>">
        <h4><?= $modalTitle ?></h4>
        <p><?= $modalMessage ?></p>
        <button class="btn btn-danger" onclick="this.parentElement.parentElement.style.display='none'">Tutup</button>
    </div>
</div>
<?php endif; ?>

<style>
.btn { 
    padding: 10px 20px; 
    border: none; 
    border-radius: 5px; 
    color: #fff; 
    text-decoration: none; 
    display: inline-block; 
    transition: 0.3s; 
    cursor: pointer;
}
.btn-success { background:#28a745; }
.btn-danger  { background:#dc3545; }

.btn-hover:hover { 
    transform: translateY(-3px); 
    box-shadow: 0 5px 15px rgba(0,0,0,0.3); 
}

/* Modal */
.modal-overlay {
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.5);
    display:flex;
    justify-content:center;
    align-items:center;
    z-index: 9999;
}
.modal-content {
    background:#fff;
    padding:20px;
    border-radius:8px;
    max-width:400px;
    width:90%;
    text-align:center;
}
.modal-content.danger { border-top:5px solid #dc3545; }
.modal-content h4 { margin-bottom:15px; }
.modal-content p { margin-bottom:20px; }
</style>
