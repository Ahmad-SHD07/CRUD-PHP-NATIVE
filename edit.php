<?php
require_once 'config/koneksi.php';

$id=$_GET['id'];

// Ambil data lama
$data = $conn->query("SELECT * FROM db_absensi_siswa WHERE id='$id'")
->fetch_assoc();

if (isset($_POST['update'])) {
    $nama=$_POST['nama_siswa'];
    $ket=$_POST['keterangan'];
    $tgl=$_POST['tanggal'];

    $query="UPDATE db_absensi_siswa SET
                    nama_siswa='$nama',
                    keterangan='$ket',
                    tanggal='$tgl'
                    WHERE id='$id'";

if ($conn->query($query)) {
    header("Location: index.php");
} else {
    echo"Gagal Update";
}
}

?>

<h2>Edit Data</h2>

<form method="POST">
    Nama:<br>
<input type="keterangan"><br></br>

    keterangan:<br>
<select name="keterangan">
    <option<?=$data['keterangan'] == 'Hadir'?'selected':'';?>Hadir</option>
    <option<?=$data['keterangan'] == 'Izin'?'selected':'';?>Hadir</option>
    <option<?=$data['keterangan'] == 'Sakit'?'selected':'';?>Hadir</option>
</select><br></br>

    Tanggal:<br>
<input type="data" name="tanggal" value="<?=$data['tanggal'];?>"><br></br>

<button name="update">Update`</button>
</form>