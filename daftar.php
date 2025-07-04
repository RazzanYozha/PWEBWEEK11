<?php
include 'koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah_asal = $_POST['sekolah_asal'];

    // Proses data file foto
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp_name = $_FILES['foto']['tmp_name'];
    $foto_size = $_FILES['foto']['size'];
    $foto_error = $_FILES['foto']['error'];
    
    // Tentukan ekstensi file yang diizinkan
    $file_ext = explode('.', $foto_name);
    $file_actual_ext = strtolower(end($file_ext));
    $allowed_ext = array('jpg', 'jpeg', 'png');

    if (in_array($file_actual_ext, $allowed_ext)) {
        if ($foto_error === 0) {
            // Batasi ukuran file (misal: maks 2MB)
            if ($foto_size < 2000000) {
                // Buat nama file baru yang unik untuk menghindari duplikat
                $new_foto_name = "IMG-" . time() . "." . $file_actual_ext;
                $file_destination = 'uploads/' . $new_foto_name;
                
                // Pindahkan file yang diunggah ke folder 'uploads'
                if (move_uploaded_file($foto_tmp_name, $file_destination)) {
                    // SQL untuk memasukkan data ke database, termasuk nama file foto
                    $sql = "INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal, foto) 
                            VALUES ('$nama', '$alamat', '$jenis_kelamin', '$agama', '$sekolah_asal', '$new_foto_name')";

                    if (mysqli_query($koneksi, $sql)) {
                        echo "<script>alert('Pendaftaran berhasil!'); window.location='siswa-terdaftar.php';</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
                    }
                } else {
                    echo "<script>alert('Gagal mengunggah foto!'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Ukuran file foto terlalu besar! Maksimal 2MB.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Terjadi error saat mengunggah file!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Format file tidak diizinkan! Hanya JPG, JPEG, dan PNG.'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Siswa Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Formulir Pendaftaran Siswa Baru</h1>
        <form action="daftar.php" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required></textarea>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label for="agama">Agama:</label>
            <select id="agama" name="agama" required>
                <option value="">Pilih</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>

            <label for="sekolah_asal">Sekolah Asal:</label>
            <input type="text" id="sekolah_asal" name="sekolah_asal" required>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" required>

            <button type="submit">Daftar</button>
        </form>
        <p><a href="index.php">Kembali ke Halaman Utama</a></p>
    </div>
</body>
</html>