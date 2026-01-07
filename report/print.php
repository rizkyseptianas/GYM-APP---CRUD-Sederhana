<?php
include "../config/koneksi.php";
include "../layout.php";

// Ambil data member
$data = mysqli_query($conn,"SELECT * FROM members ORDER BY created_at DESC");

// Cek apakah ada data
$adaData = mysqli_num_rows($data) > 0;
?>

<div class="container col-md-10 my-5 report-page">
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
                <table class="table table-dark table-striped table-hover table-bordered align-middle">
                    <thead class="bg-dark text-white">
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

