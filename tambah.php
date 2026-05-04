<?php
require_once 'config/koneksi.php';

// Proses simpan data saat tombol Submit ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_siswa = trim($_POST['nama_siswa']);
    $kelas = trim($_POST['kelas']);
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Menggunakan Prepared Statement untuk keamanan tingkat tinggi
    $stmt = $conn->prepare("INSERT INTO tb_absensi (nama_siswa, kelas, tanggal, status) VALUES (?, ?, ?, ?)");
    
    // "ssss" berarti keempat variabel di atas adalah String
    $stmt->bind_param("ssss", $nama_siswa, $kelas, $tanggal, $status);

    if ($stmt->execute()) {
        // Jika sukses, kembalikan ke halaman index
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan data: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Form Tambah Absensi</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" name="kelas" id="kelas" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="form-label">Status Kehadiran</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih Status --</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpa">Alpa</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">Simpan Data</button>
                            <a href="index.php" class="btn btn-secondary w-100">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>