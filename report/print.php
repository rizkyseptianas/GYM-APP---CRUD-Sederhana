<?php
include "../config/koneksi.php";
include "../layout.php";

// Ambil data member
$data = mysqli_query($conn,"SELECT * FROM members ORDER BY created_at DESC");

// Cek apakah ada data
$adaData = mysqli_num_rows($data) > 0;
?>

<div class="container col-md-10 my-5">
    <div class="glass p-4 shadow-lg rounded-4">
        <h3 class="text-center mb-4" style="font-weight:700; color:#4a90e2;">Report Member</h3>

        <!-- Alert jika kosong -->
        <?php if(!$adaData){ ?>
            <div class="alert alert-warning text-center" style="font-weight:600;">Belum ada data member!</div>
        <?php } ?>

        <!-- Tombol Print -->
        <?php if($adaData){ ?>
            <div class="text-end mb-3">
                <button onclick="window.print()" class="btn btn-success btn-hover"><i class="bi bi-printer"></i> Print</button>
            </div>
        <?php } ?>

        <!-- Tabel Data -->
        <?php if($adaData){ ?>
            <div style="overflow-x:auto;">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="text-white" style="background: linear-gradient(to right, #4a90e2, #50e3c2);">
                        <tr>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Paket</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($r=mysqli_fetch_assoc($data)){ ?>
                        <tr>
                            <td><?= htmlspecialchars($r['nama']) ?></td>
                            <td><?= $r['umur'] ?></td>
                            <td><?= $r['paket'] ?></td>
                            <td>
                               <?php if(trim(strtolower($r['status_member'])) == 'aktif'){ ?>
                                    <span class="badge bg-success"><?= $r['status_member'] ?></span>
                               <?php } else { ?>
                                    <span class="badge bg-danger"><?= $r['status_member'] ?></span>
                               <?php } ?>

                            </td>
                            <td><?= date('d M Y', strtotime($r['tanggal_daftar'])) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

<style>
.glass {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
}

.btn-hover {transition: all 0.3s ease;}
.btn-hover:hover {transform: translateY(-3px); box-shadow:0 5px 15px rgba(0,0,0,0.3);}

table th, table td {
    vertical-align: middle;
}

table tbody tr:hover {
    background-color: rgba(74, 144, 226, 0.1);
}

@media print {
    button, a {display:none !important;}
    body {background: #fff; color:#000;}
    table {border-collapse: collapse; width: 100%;}
}
</style>
