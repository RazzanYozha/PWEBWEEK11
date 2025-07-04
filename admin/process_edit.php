<?php
session_start();
include '../koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah_asal = $_POST['sekolah_asal'];

    // **PENTING: Lindungi dari SQL Injection!**
    // Ini adalah versi sederhana, untuk aplikasi produksi gunakan Prepared Statements.
    $id = mysqli_real_escape_string($koneksi, $id);
    $nama = mysqli_real_escape_string($koneksi, $nama);
    $alamat = mysqli_real_escape_string($koneksi, $alamat);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $jenis_kelamin);
    $agama = mysqli_real_escape_string($koneksi, $agama);
    $sekolah_asal = mysqli_real_escape_string($koneksi, $sekolah_asal);

    $sql = "UPDATE calon_siswa SET 
            nama = '$nama', 
            alamat = '$alamat', 
            jenis_kelamin = '$jenis_kelamin', 
            agama = '$agama', 
            sekolah_asal = '$sekolah_asal' 
            WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data siswa berhasil diupdate!'); window.location='dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
} else {
    header("Location: dashboard.php"); // Redirect jika bukan POST request
    exit();
}
?>