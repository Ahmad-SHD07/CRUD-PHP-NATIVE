<?php
require_once 'config/koneksi.php';

// 1. Ambil data untuk tabel
$query = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);

// 2. Ambil data untuk ringkasan (Summary)
$sql_summary = "SELECT 
    COUNT(CASE WHEN keterangan = 'Hadir' THEN 1 END) as jml_hadir,
    COUNT(CASE WHEN keterangan = 'Izin' THEN 1 END) as jml_izin,
    COUNT(CASE WHEN keterangan = 'Sakit' THEN 1 END) as jml_sakit
    FROM tb_absensi";
$summary = $conn->query($sql_summary)->fetch_assoc();

if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi | Modern Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .card { border: none; border-radius: 12px; }
        .stat-card { transition: transform 0.2s; border-left: 5px solid; }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-circle { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 50%;}
        .status-badge { min-width: 85px; font-weight: 500; border-radius: 8px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <span class="navbar-brand fw-bold"><i class="bi bi-person-check-fill me-2"></i>Absensi SMK YADIKA</span>
        </div>
    </nav>

    <div class="container mb-5">
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm border-success bg-white p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-success-subtle text-success icon-circle me-3">
                            <i class="bi bi-person-check fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small fw-semibold">Total Hadir</h6>
                            <h3 class="fw-bold mb-0"><?= $summary['jml_hadir']; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card stat-card shadow-sm border-warning bg-white p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-warning-subtle text-warning icon-circle me-3">
                            <i class="bi bi-person-exclamation fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small fw-semibold">Total Izin</h6>
                            <h3 class="fw-bold mb-0"><?= $summary['jml_izin']; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card stat-card shadow-sm border-danger bg-white p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-danger-subtle text-danger icon-circle me-3">
                            <i class="bi bi-person-x fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small fw-semibold">Total Sakit</h6>
                            <h3 class="fw-bold mb-0"><?= $summary['jml_sakit']; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Daftar Kehadiran</h5>
                <a href="tambah.php" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Absen
                </a>
            </div>
            <div class="card-body p-0 text-center">
                <div class="table-responsive text-center">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3">Nama Siswa</th>
                                <th class="py-3">Kelas</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = $result->num_rows; // Penomoran lanjut (berhitung mundur dari total data)
                            while ($row = $result->fetch_assoc()) {
                                $badge = "bg-secondary-subtle text-secondary border border-secondary";
                                if ($row['keterangan'] == "Hadir") $badge = "bg-success-subtle text-success border border-success";
                                if ($row['keterangan'] == "Izin") $badge = "bg-warning-subtle text-warning border border-warning";
                                if ($row['keterangan'] == "Sakit") $badge = "bg-danger-subtle text-danger border border-danger";
                            ?>
                                <tr>
                                    <td class="text-muted small fw-bold"><?= $no--; ?></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($row['nama_siswa']); ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($row['kelas'] ?? '-'); ?></span></td>
                                    <td>
                                        <span class="badge status-badge <?= $badge; ?>">
                                            <?= htmlspecialchars($row['keterangan']); ?>
                                        </span>
                                    </td>
                                    <td class="small text-muted"><?= $row['tanggal']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                                            <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus data?')"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>