<?php 
require_once 'config/koneksi.php'; 
$query = "SELECT * FROM tb_absensi ORDER BY id DESC"; 
$result = $conn->query($query); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Siswa</title>
    <!-- Memanggil CSS Bootstrap dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Data Absensi Siswa</h2>
        
        <!-- Tombol Tambah Data -->
        <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Absensi</a>

        <!-- Tabel Bootstrap -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($result->num_rows > 0) {
                            // Looping data dari database
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['nama_siswa'] . "</td>";
                                echo "<td>" . $row['kelas'] . "</td>";
                                echo "<td>" . $row['tanggal'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>
                                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href='hapus.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                                        </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Belum ada data absensi</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>