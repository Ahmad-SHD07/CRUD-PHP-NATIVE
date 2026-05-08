<?php
require_once 'config/koneksi.php';

$id = $_GET['id'];

// Ambil data lama
$query_data = "SELECT * FROM tb_absensi WHERE id='$id'";
$result_data = $conn->query($query_data);
$data = $result_data->fetch_assoc();

if (isset($_POST['update'])) {
    $nama  = $_POST['nama_siswa'];
    $kelas = $_POST['kelas']; // Ambil data kelas dari dropdown
    $ket   = $_POST['keterangan'];
    $tgl   = $_POST['tanggal'];

    $query = "UPDATE tb_absensi SET 
                nama_siswa='$nama', 
                kelas='$kelas', 
                keterangan='$ket', 
                tanggal='$tgl' 
              WHERE id='$id'";

    if ($conn->query($query)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Gagal Update: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Absensi | Modern CRUD</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; color: #334155; }
        .card { border: 1px solid rgba(0,0,0,0.08); border-radius: 12px; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #e2e8f0; }
        .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15); }
        .btn-primary { background-color: #0d6efd; border-color: #0d6efd; padding: 0.7rem; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .btn-primary:hover { background-color: #0b5ed7; border-color: #0a58ca; transform: translateY(-1px); }
        .btn-secondary { background-color: #ffffff; color: #475569; border: 1px solid #e2e8f0; padding: 0.7rem; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .btn-secondary:hover { background-color: #f8f9fa; color: #1e293b; border-color: #cbd5e1; transform: translateY(-1px); }
        .breadcrumb-item a { color: #0d6efd; }
        .breadcrumb-item.active { color: #64748b; font-weight: 500; }
        .form-floating label { color: #64748b; padding-left: 1.25rem; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fa-solid fa-user-check me-2"></i>Absensi-Ku</a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none"><i class="fa-solid fa-home me-1"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Daftar Absensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-5">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fa-solid fa-user-pen text-primary fs-4"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-1">Edit Absensi</h3>
                                <p class="text-muted small mb-0">Perbarui data kehadiran siswa di bawah ini.</p>
                            </div>
                        </div>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger border-0 small"><i class="fa-solid fa-triangle-exclamation me-2"></i><?= $error; ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" name="nama_siswa" class="form-control" id="floatingNama" placeholder="Nama Lengkap Siswa" value="<?= htmlspecialchars($data['nama_siswa'] ?? ''); ?>" required>
                                <label for="floatingNama"><i class="fa-solid fa-user me-2"></i>Nama Lengkap Siswa</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select name="kelas" class="form-select" id="floatingKelas" aria-label="Kelas / Jurusan" required>
                                    <option value="PPLG" <?= ($data['kelas'] ?? '') == 'PPLG' ? 'selected' : ''; ?>>PPLG</option>
                                    <option value="RPL" <?= ($data['kelas'] ?? '') == 'RPL' ? 'selected' : ''; ?>>RPL</option>
                                    <option value="TKJ" <?= ($data['kelas'] ?? '') == 'TKJ' ? 'selected' : ''; ?>>TKJ</option>
                                    <option value="DKV" <?= ($data['kelas'] ?? '') == 'DKV' ? 'selected' : ''; ?>>DKV</option>
                                    <option value="AKL" <?= ($data['kelas'] ?? '') == 'AKL' ? 'selected' : ''; ?>>AKL</option>
                                    <option value="PERHOTELAN" <?= ($data['kelas'] ?? '') == 'PERHOTELAN' ? 'selected' : ''; ?>>PERHOTELAN</option>
                                    <option value="TATABOGA" <?= ($data['kelas'] ?? '') == 'TATABOGA' ? 'selected' : ''; ?>>TATABOGA</option>
                                    <option value="PERKANTORAN" <?= ($data['kelas'] ?? '') == 'PERKANTORAN' ? 'selected' : ''; ?>>PERKANTORAN</option>
                                </select>
                                <label for="floatingKelas"><i class="fa-solid fa-building me-2"></i>Kelas / Jurusan</label>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="form-floating">
                                        <select name="keterangan" class="form-select" id="floatingKet" aria-label="Status Kehadiran" required>
                                            <option value="Hadir" <?= ($data['keterangan'] ?? '') == 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
                                            <option value="Izin" <?= ($data['keterangan'] ?? '') == 'Izin' ? 'selected' : ''; ?>>Izin</option>
                                            <option value="Sakit" <?= ($data['keterangan'] ?? '') == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
                                        </select>
                                        <label for="floatingKet"><i class="fa-solid fa-clipboard-user me-2"></i>Status Kehadiran</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="tanggal" class="form-control" id="floatingTanggal" value="<?= htmlspecialchars($data['tanggal'] ?? ''); ?>" required>
                                        <label for="floatingTanggal"><i class="fa-solid fa-calendar-days me-2"></i>Tanggal</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                                <a href="index.php" class="btn btn-secondary px-4 order-2 order-md-1">
                                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" name="update" class="btn btn-primary px-4 order-1 order-md-2">
                                    <i class="fa-solid fa-save me-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>