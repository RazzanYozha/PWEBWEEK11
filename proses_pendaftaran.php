<?php

include("koneksi.php");

if(isset($_POST['Daftar'])){

    // Ambil data dari formulir
    $nama = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah_asal = $_POST['sekolah_asal'];

    // Proses file foto yang diunggah
    $nama_file = $_FILES['foto']['name'];
    $ukuran_file = $_FILES['foto']['size'];
    $tipe_file = $_FILES['foto']['type'];
    $tmp_file = $_FILES['foto']['tmp_name'];

    // Tentukan path untuk menyimpan file
    $path = "uploads/".$nama_file;

    // Cek apakah tipe file adalah gambar
    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
        // Cek jika ukuran file tidak lebih dari 1MB
        if($ukuran_file <= 1000000){ 
            // Jika semua pengecekan berhasil, pindahkan file
            if(move_uploaded_file($tmp_file, $path)){

                // Buat query untuk memasukkan data ke database (termasuk nama file foto)
                $sql = "INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal, foto) VALUE ('$nama', '$alamat', '$jenis_kelamin', '$agama', '$sekolah_asal', '$nama_file')";

                $query = mysqli_query($db, $sql);

                if( $query ) {
                    // Jika berhasil, alihkan ke halaman terima kasih
                    header('Location: halaman-terima-kasih.php');
                } else {
                    // Jika query gagal
                    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
                    echo "<br><a href='daftar.php'>Kembali Ke Form</a>";
                }
            } else {
                // Jika file gagal diunggah
                echo "Maaf, Foto gagal untuk diunggah.";
                echo "<br><a href='daftar.php'>Kembali Ke Form</a>";
            }
        } else {
            // Jika ukuran file terlalu besar
            echo "Maaf, Ukuran gambar yang diunggah tidak boleh lebih dari 1MB.";
            echo "<br><a href='daftar.php'>Kembali Ke Form</a>";
        }
    } else {
        // Jika tipe file bukan gambar
        echo "Maaf, Tipe gambar yang diunggah harus JPG atau PNG.";
        echo "<br><a href='daftar.php'>Kembali Ke Form</a>";
    }

} else {
    die("Akses dilarang...");
}

?>