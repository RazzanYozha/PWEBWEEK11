<?php
$host = "localhost"; // Ganti jika database Anda di server lain
$user = "root";      // Username database Anda
$pass = "";          // Password database Anda (kosongkan jika tidak ada)
$db = "pendaftaran_siswa"; // Nama database yang sudah kita buat

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>