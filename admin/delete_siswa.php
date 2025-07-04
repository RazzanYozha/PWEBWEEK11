<?php
session_start();
include '../koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];

    // **PENTING: Lindungi dari SQL Injection!**
    $id_siswa = mysqli_real_escape_string($koneksi, $id_siswa);

    $sql = "DELETE FROM calon_siswa WHERE id = $id_siswa";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data siswa berhasil dihapus!'); window.location='dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
} else {
    header("Location: dashboard.php"); // Redirect jika tidak ada ID
    exit();
}
?>