<h1>Pembuatan Proyek Pendaftaran Siswa - PDF</h1>
Proyek ini bertujuan untuk mendaftarkan siswa ke dalam sekolah

<h2>Fitur - Fitur</h2>

- Sistem Pendaftaran
- Melihat Data Siswa
- Mengaplikasikan Sistem CRUD (create,read,update,delete)
- Mencetak data Dengan Format PDF

<h3>Formulir Pendaftaran</h3>

![image](https://github.com/user-attachments/assets/18e15170-684d-498f-a161-600e41cd1155)
Pada formulir pendaftaran ini calon siswa diwajibkan melengkapi data diri yang ada di form

<h3>Data Siswa</h3>

![image](https://github.com/user-attachments/assets/0376c438-a083-48cc-b32b-c2d8203a0c56)
siswa yang sudah mendaftar dapat melihat data mereka pada data pendaftaran

<h3>Dashboard Admin</h3>

![image](https://github.com/user-attachments/assets/970abd20-f92c-48e0-ac4f-b39a7255caa3)
Admin dapat melakukan edit dan menghapus data siswa

<h3>Mencetak PDF</h3>

![image](https://github.com/user-attachments/assets/65ad34c3-5961-40e7-b5bb-2ac0795b8409)
Data siswa dapat dicetak dengan format PDF

<h2>Implementasi</h2>

<h3>Database</h3>

Database ini terdiri dari satu tabel utama yaitu `calon_siswa` dengan struktur sebagai berikut:

```sql
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    tanggal_lahir DATE NOT NULL
);
```

<h3>Koneksi Database</h3>

Koneksi database diimplementasikan di file `koneksi.php`:

```php
<?php
$host = "localhost"; 
$user = "root";      
$pass = "";          
$db = "pendaftaran_siswa"; 

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
```
<h3>Pembuatan PDF</h3>
Pembuatan PDF menggunakan library FPDF dengan implementasi sebagai berikut:

1. Siapkan Library FPDF

- Unduh FPDF dari situs resminya dan letakkan folder fpdf (yang berisi `fpdf.php`) di dalam direktori utama proyek.

2. Buat Skrip Laporan

- Buat file PHP baru untuk laporan.
- Di dalam file tersebut, `require file` `fpdf.php` dan `include` file koneksi database.
- Ambil data dari tabel `calon_siswa` menggunakan query SQL.
- Gunakan fungsi-fungsi FPDF seperti `$pdf->Cell()` untuk menulis data ke dalam PDF baris per baris di dalam sebuah perulangan (`while`).

3. Buat Tombol pada Web

- Pada halaman dashboard admin, tambahkan sebuah tautan (`<a>`) yang mengarah ke file `laporan_pdf.php`.
- Gunakan `target="_blank"` agar laporan terbuka di tab baru.
