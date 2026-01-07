<?php
include "../config/koneksi.php";

// Mulai session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$showModal = false;
$modalTitle = "";
$modalMessage = "";
$modalType = ""; // success atau danger

if (isset($_POST['login'])) {
    $usernameOrEmail = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Cek username atau email
    $query = mysqli_query($conn,"SELECT * FROM users WHERE username='$usernameOrEmail' OR email='$usernameOrEmail'");
    $data = mysqli_fetch_assoc($query);

    $showModal = true; 
    if ($data && password_verify($password, $data['password'])) {
        // Login sukses
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];

        $modalTitle = "Sukses!";
        $modalMessage = "Login berhasil! Redirecting...";
        $modalType = "success";

        // Redirect otomatis ke index.php setelah 1 detik
        echo "<script>setTimeout(function(){ window.location.href = '../index.php'; }, 1000);</script>";
    } else {
        // Login gagal
        $modalTitle = "Gagal!";
        $modalMessage = "Username/email atau password salah!";
        $modalType = "danger";
    }
}

include "../layout.php";
?>

<div class="container col-md-4">
    <div class="glass p-4">
        <h3 class="text-center mb-4">Login Admin</h3>
        <form method="POST">
            <input class="form-control mb-3" name="username" placeholder="Username atau Email" required>
            <input type="password" class="form-control mb-3" name="password" placeholder="Masukkan password" required>
            <button name="login" class="btn btn-primary w-100 btn-hover">Login</button>
        </form>
        <p class="mt-3 text-center">
            Belum punya akun? <a href="register.php" class="text-white fw-bold">Register</a>
        </p>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-<?= $modalType ?> text-white">
        <h5 class="modal-title"><?= $modalTitle ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body"><?= $modalMessage ?></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-<?= $modalType ?>" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<style>
.btn-hover {transition: all 0.3s ease;}
.btn-hover:hover {transform: translateY(-3px); box-shadow:0 5px 15px rgba(0,0,0,0.3);}
</style>

<?php if($showModal){ ?>
<script>
var myModal = new bootstrap.Modal(document.getElementById('alertModal'));
myModal.show();
</script>
<?php } ?>
