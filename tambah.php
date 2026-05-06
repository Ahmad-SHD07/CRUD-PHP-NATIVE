<?php
require_once'config/koneksi.php';

if (isset($_POST['simpan'])) {
$nama=$_POST['nama_siswa'];
$kelas=$_POST['kelas'];
$ket=$_POST['keterangan'];
$tgl=$_POST['tanggal'];

$query="INSERT INTO tb_absensi (nama_siswa, kelas, keterangan, tanggal)
            VALUES ('$nama', '$kelas', '$ket', '$tgl')";

if ($conn->query($query)) {
header("Location: index.php");
    }else {
echo"Gagal: ". $conn->error;
    }
}

?>

<h2>Tambah Data</h2>

<form method="POST">
    Nama Siswa:<br>
<input type="text" name="nama_siswa"><br><br>

    Kelas:<br>
<input type="text" name="kelas"><br></br>

    Keterangan:<br>
<select name="keterangan">
<option value="Hadir">Hadir</option>
<option value="Izin">Izin</option>
<option value="Sakit">Sakit</option>
</select><br><br>

    Tanggal:<br>
<input type="date" name="tanggal"><br><br>

<button type="submit" name="simpan">Simpan</button>
</form>