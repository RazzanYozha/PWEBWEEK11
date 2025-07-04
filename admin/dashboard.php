<?php
session_start();
include '../koneksi.php'; // Perhatikan path koneksi.php!

// Cek apakah admin sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); // Arahkan kembali ke halaman login jika belum login
    exit();
}

// Ambil data siswa
$sql = "SELECT * FROM calon_siswa";
$result = mysqli_query($koneksi, $sql);

// Tambahkan pengecekan jika query gagal
if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pendaftaran Siswa</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* CSS tambahan untuk tombol di tabel admin */
        .action-buttons a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            margin-bottom: 5px; /* Tambahkan margin bawah */
            text-decoration: none;
            border-radius: 3px;
            text-align: center;
            min-width: 50px;
        }
        .action-buttons .edit-btn {
            background-color: #ffc107; /* Kuning */
            color: black;
        }
        .action-buttons .delete-btn {
            background-color: #dc3545; /* Merah */
            color: white;
        }
        .logout-button {
            float: right;
            margin-top: -50px; /* Sesuaikan posisi jika perlu */
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>Dashboard Admin</h1>
    <a href="logout.php" class="logout-button">Logout</a>
    <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    
    <a href="../laporan_pdf.php" target="_blank" class="action-buttons edit-btn">Cetak Laporan PDF</a>

    <h2>Daftar Siswa</h2>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Sekolah Asal</th>
                        <th>Foto</th> <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['jenis_kelamin']; ?></td>
                            <td><?php echo $row['agama']; ?></td>
                            <td><?php echo $row['sekolah_asal']; ?></td>
                            <td><img src="../uploads/<?php echo $row['foto']; ?>" class="foto-siswa"></td>
                            <td class="action-buttons">
                                <a href="edit_siswa.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                                <a href="delete_siswa.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Belum ada siswa yang mendaftar.</p>
        <?php endif; ?>
    </div>
</body>
</html>