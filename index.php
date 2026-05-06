<?php
require_once 'config/koneksi.php';

// Query ambil data
$query = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);

// Cek error query
if (!$result) {
    die("Query gagal: " . $conn->error);
};

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-19">

                <!-- Card Container -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                        <h4 class="mb-0">Data Absensi</h4>
                        <a href="tambah.php" class="btn btn-primary btn-sm fw-bold">+ Tambah Data</a>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Nama Siswa</th>
                                        <th class="text-center">Kelas</th>
                                        <th width="20%" class="text-center">Keterangan</th>
                                        <th width="20%" class="text-center">Tanggal</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;

                                    // Loop Data
                                    while ($row = $result->fetch_assoc()) {
                                        // Memberikan warna sesuai keterangannya
                                        $badge_color = "bg-secondary";
                                        if ($row['keterangan'] == "Hadir") $badge_color = 'bg-success';
                                        if ($row['keterangan'] == "Izin") $badge_color = 'bg-warning';
                                        if ($row['keterangan'] == "Sakit") $badge_color = 'bg-danger';

                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="fw-medium"> <?= htmlspecialchars($row['nama_siswa']); ?></td>
                                            <td class="text-center"> <?= htmlspecialchars($row['kelas']);  ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= $badge_color; ?> px-3 py-2" style="min-width: 80px">
                                                    <?= htmlspecialchars($row['keterangan']) ?>
                                                </span>
                                            </td>
                                            <td class="fw-medium"><?= htmlspecialchars($row['tanggal']); ?></td>
                                            <td class="text-center">
                                                <a href="edit.php?id=<?= $row['id']; ?> " class="btn btn-outline-secondary btn-sm">Edit</a>
                                                <a href="hapus.php?id=<?= $row['id']; ?> " 
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php 
                                    }
                                    // Jika data kosong
                                    if ($result->num_rows == 0) {
                                        echo "<tr><td colspan='5' class='text-center text-muted py-3'>Belum ada data absensi.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>