<?php
require_once 'config/koneksi.php';

$id=$_GET['id'];

// Ambil data lama
$data = $conn->query("SELECT * FROM tb_absensi WHERE id='$id'")
                ->fetch_assoc();

if (isset($_POST['update'])) {
    $nama=$_POST['nama_siswa'];
    $kelas=$_POST['kelas'];
    $ket=$_POST['keterangan'];
    $tgl=$_POST['tanggal'];

    $query="UPDATE tb_absensi SET
                    nama_siswa='$nama',
                    kelas='$kelas',
                    keterangan='$ket',
                    tanggal='$tgl'
                    WHERE id='$id'";

if ($conn->query($query)) {
    header("Location: index.php");
} else {
    echo"Gagal Update";
};
}

?>

<h2>Edit Data</h2>

<form method="POST">
    Nama:<br>
<input type="teks" name="nama_siswa" value="<?= $data['nama_siswa']; ?>"><br></br>

    Kelas:<br>
<input type="text" name="kelas" value="<?= htmlspecialchars($data['kelas']); ?>"><br><br>

    keterangan:<br>
<select name="keterangan" class="form-select">
    <option value="Hadir" <?= $data['keterangan'] == 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
    <option value="Izin" <?= $data['keterangan'] == 'Izin' ? 'selected' : ''; ?>>Izin</option>
    <option value="Sakit" <?= $data['keterangan'] == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
</select><br></br>

    Tanggal:<br>
<input type="date" name="tanggal" value=" <?=$data['tanggal']; ?>"><br></br>

<button name="update">Update</button>
</form>