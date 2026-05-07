<?php
require_once 'config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama  = $_POST['nama_siswa'];
    $kelas = $_POST['kelas']; 
    $ket   = $_POST['keterangan'];
    $tgl   = $_POST['tanggal'];

    $query = "INSERT INTO tb_absensi (nama_siswa, kelas, keterangan, tanggal) 
                VALUES ('$nama', '$kelas', '$ket', '$tgl')";

    if ($conn->query($query)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Gagal menyimpan data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Absensi | Modern CRUD</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #334155;
        }
        .card {
            border: none;
            border-radius: 12px;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #475569;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            border: 1px solid #e2e8f0;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .btn-save {
            background-color: #2563eb;
            border: none;
            border-radius: 8px;
            padding: 0.7rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-save:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }
        .btn-back {
            border-radius: 8px;
            padding: 0.7rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-person-check-fill me-2"></i>Absensi-Ku</a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                
                <div class="mb-4">
                    <a href="index.php" class="text-decoration-none text-muted small fw-medium">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Absensi
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="fw-bold mb-1">Tambah Absensi</h3>
                        <p class="text-muted small mb-4">Silakan isi formulir di bawah ini dengan lengkap.</p>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger border-0 small"><?= $error; ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap Siswa</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                    <input type="text" name="nama_siswa" class="form-control border-start-0" placeholder="Contoh: Ahmad Sholehuddin" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kelas / Jurusan</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-building"></i></span>
                                            <select name="kelas" class="form-select border-start-0" required>
                                                <option value="" disabled selected>Pilih Jurusan...</option>
                                                <option value="PPLG">PPLG</option>
                                                <option value="RPL">RPL</option>
                                                <option value="TKJ">TKJ</option>
                                                <option value="DKV">DKV</option>
                                                <option value="AKL">AKL</option>
                                                <option value="PERHOTELAN">PERHOTELAN</option>
                                                <option value="TATABOGA">TATABOGA</option>
                                                <option value="PERKANTORAN">PERKANTORAN</option>
                                            </select>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Kehadiran</label>
                                    <select name="keterangan" class="form-select" required>
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <div class="d-grid gap-2">
                                <button type="submit" name="simpan" class="btn btn-primary btn-save">
                                    <i class="bi bi-check-circle me-2"></i>Simpan Data
                                </button>
                                <a href="index.php" class="btn btn-light btn-back border">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-4 small">SMK YADIKA SOREANG - Sistem Absensi &copy; 2026</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>