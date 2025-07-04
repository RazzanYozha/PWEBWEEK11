<?php
session_start(); // Mulai session

$pesan_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username dan password
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = 'admin';
        header("Location: dashboard.php"); // Arahkan ke dashboard admin
        exit();
    } else {
        $pesan_error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Pendaftaran Siswa</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <div class="container">
        <h1>Login Admin</h1>
        <?php if (!empty($pesan_error)): ?>
            <p style="color: red; text-align: center;"><?php echo $pesan_error; ?></p>
        <?php endif; ?>
        <form action="index.php" method="POST">
            <label for="username">Username: (admin)</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password: (admin123) </label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
            
            <a href="../index.php" class="link-kembali">Kembali ke Halaman Utama</a>
        </form>
    </div>
</body>
</html>