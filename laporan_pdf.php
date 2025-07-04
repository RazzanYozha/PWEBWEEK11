<?php
// Memanggil file fpdf.php
require('fpdf/fpdf.php');
// Memanggil file koneksi.php
include('koneksi.php');

// Membuat class baru yang mewarisi sifat dari class FPDF
// Class ini digunakan untuk membuat header dan footer laporan
class PDF extends FPDF
{
    // Fungsi untuk membuat header
    function Header()
    {
        // Set font
        $this->SetFont('Arial','B',14);
        // Judul Laporan
        $this->Cell(0,10,'LAPORAN DATA PENDAFTARAN SISWA',0,1, 'C');
        $this->Ln(5); // Jarak baris
    }

    // Fungsi untuk membuat footer
    function Footer()
    {
        // Posisi 1.5 cm dari bawah
        $this->SetY(-15);
        // Set font
        $this->SetFont('Arial','I',8);
        // Penomoran halaman
        $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Inisiasi class PDF
$pdf = new PDF();
$pdf->AliasNbPages(); // Menghitung total halaman
$pdf->AddPage('L', 'A4'); // Tambah halaman baru, 'L' untuk landscape, 'A4' untuk ukuran

// Set font untuk isi tabel
$pdf->SetFont('Arial','',10);

// Membuat Header Tabel
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(230, 230, 230); // Warna latar header
$pdf->Cell(10,12,'ID',1,0,'C', true);
$pdf->Cell(40,12,'Nama Siswa',1,0,'C', true);
$pdf->Cell(60,12,'Alamat',1,0,'C', true);
$pdf->Cell(30,12,'Jenis Kelamin',1,0,'C', true);
$pdf->Cell(30,12,'Agama',1,0,'C', true);
$pdf->Cell(45,12,'Sekolah Asal',1,0,'C', true);
$pdf->Cell(45,12,'Foto',1,1,'C', true); // `1` di akhir untuk pindah baris

// Mengambil data dari database
$sql = "SELECT * FROM calon_siswa";
$query = mysqli_query($koneksi, $sql);

while ($row = mysqli_fetch_array($query)) {
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10,10,$row['id'],1,0,'C');
    $pdf->Cell(40,10,$row['nama'],1,0);
    $pdf->Cell(60,10,$row['alamat'],1,0);
    $pdf->Cell(30,10,$row['jenis_kelamin'],1,0,'C');
    $pdf->Cell(30,10,$row['agama'],1,0,'C');
    $pdf->Cell(45,10,$row['sekolah_asal'],1,0);
    $pdf->Cell(45,10,$row['foto'],1,1); // `1` di akhir untuk pindah baris
}

// Menghasilkan output file PDF
$pdf->Output();
?>