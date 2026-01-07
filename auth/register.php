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

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        $showModal = true;
        $modalTitle = "Error!";
        $modalMessage = "Password dan Konfirmasi Password tidak sama!";
        $modalType = "danger";
    } else {
        // cek username atau email sudah dipakai
        $check = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' OR email='$email'");
        if(mysqli_num_rows($check) > 0){
            $showModal = true;
            $modalTitle = "Error!";
            $modalMessage = "Username atau Email sudah digunakan!";
            $modalType = "danger";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // insert user baru (admin) tanpa role
            $insert = mysqli_query($conn,"INSERT INTO users (username,email,password) VALUES('$username','$email','$hash')");
            if($insert){
                $showModal = true;
                $modalTitle = "Sukses!";
                $modalMessage = "Register admin berhasil! <a href='login.php' class='text-white fw-bold'>Login sekarang</a>";
                $modalType = "success";
            } else {
                $showModal = true;
                $modalTitle = "Error!";
                $modalMessage = "Gagal register, coba lagi!";
                $modalType = "danger";
            }
        }
    }
}

include "../layout.php";
?>

<div class="container col-md-4">
    <div class="glass p-4">
        <h3 class="text-center mb-4">Register Admin</h3>
        <form method="POST">
            <input class="form-control mb-3" name="username" placeholder="Masukkan username" required>
            <input type="email" class="form-control mb-3" name="email" placeholder="Masukkan email" required>
            <input type="password" class="form-control mb-3" name="password" placeholder="Masukkan password" required>
            <input type="password" class="form-control mb-3" name="password2" placeholder="Konfirmasi password" required>
            <button name="register" class="btn btn-success w-100 btn-hover">Register Admin</button>
        </form>
        <p class="mt-3 text-center">
            Sudah punya akun? <a href="login.php" class="text-white fw-bold">Login</a>
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
