<?php
require_once 'config/koneksi.php';

$id=$_GET['id'];

$query="DELETED FROM db_absensi_siswa WHERE id='$id'";

if ($conn -> query($query)) {
    header("Location: index.php");
} else {
    echo "Gagal Hapus";
}

?>