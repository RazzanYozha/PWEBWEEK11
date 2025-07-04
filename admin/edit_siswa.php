<?php
session_start();
include '../koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

$id_siswa = $_GET['id']; // Ambil ID siswa dari URL

// Ambil data siswa berdasarkan ID
$sql = "SELECT * FROM calon_siswa WHERE id = $id_siswa";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Data siswa tidak ditemukan.");
}

$siswa = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa - Pendaftaran Siswa</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Data Siswa</h1>
        <form action="process_edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $siswa['id']; ?>">

            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $siswa['nama']; ?>" required>

            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required><?php echo $siswa['alamat']; ?></textarea>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" <?php echo ($siswa['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?php echo ($siswa['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
            </select>

            <label for="agama">Agama:</label>
            <select id="agama" name="agama" required>
                <option value="Islam" <?php echo ($siswa['agama'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                <option value="Kristen" <?php echo ($siswa['agama'] == 'Kristen') ? 'selected' : ''; ?>>Kristen</option>
                <option value="Katolik" <?php echo ($siswa['agama'] == 'Katolik') ? 'selected' : ''; ?>>Katolik</option>
                <option value="Hindu" <?php echo ($siswa['agama'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                <option value="Buddha" <?php echo ($siswa['agama'] == 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                <option value="Konghucu" <?php echo ($siswa['agama'] == 'Konghucu') ? 'selected' : ''; ?>>Konghucu</option>
            </select>

            <label for="sekolah_asal">Sekolah Asal:</label>
            <input type="text" id="sekolah_asal" name="sekolah_asal" value="<?php echo $siswa['sekolah_asal']; ?>" required>

            <button type="submit">Update Data</button>
        </form>
        <p><a href="dashboard.php">Kembali ke Dashboard Admin</a></p>
    </div>
</body>
</html>