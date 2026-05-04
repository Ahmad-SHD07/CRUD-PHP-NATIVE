<?php
require_once'config/koneksi.php';

if (isset($_POST['simpan'])) {
$nama=$_POST['nama_siswa'];
$ket=$_POST['keterangan'];
$tgl=$_POST['tanggal'];

$query="INSERT INTO tb_absensi (nama_siswa, keterangan, tanggal)
            VALUES ('$nama', '$ket', '$tgl')";

if ($conn->query($query)) {
header("Location: index.php");
    }else {
echo"Gagal: ". $conn->error;
    }
}
?>

<h2>Tambah Data</h2>

<formmethod="POST">
    Nama Siswa:<br>
<inputtype="text"name="nama_siswa"><br><br>

    Keterangan:<br>
<selectname="keterangan">
<optionvalue="Hadir">Hadir</option>
<optionvalue="Izin">Izin</option>
<optionvalue="Sakit">Sakit</option>
</select><br><br>

    Tanggal:<br>
<inputtype="date"name="tanggal"><br><br>

<buttontype="submit"name="simpan">Simpan</button>
</form>