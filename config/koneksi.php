<?php 
define('DB_HOST', '127.0.0.1'); //Server Database
define('DB_USER', 'root'); //username
define('DB_PASS', ''); //password
define('DB_NAME', 'db_absensi_siswa'); //Nama database

// Membuat koneksi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal:" . $conn->connect_error);
} else {
    echo "Koneksi ke db_absensi_siswa Berhasil";
}

$conn->set_charset("utf8");
?>