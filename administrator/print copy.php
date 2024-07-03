<?php
use Fpdf\Fpdf;

require('../fpdf/src/Fpdf/Fpdf.php');
include '../koneksi.php';

$pdf = new Fpdf('l','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(275,10,'DATA PENGADUAN',0,1,'C');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,10,'NO',1,0,'C');
$pdf->Cell(45,10,'FOTO',1,0,'C');
$pdf->Cell(60,10,'ISI LAPORAN',1,0,'C');
$pdf->Cell(50,10,'ISI TANGGAPAN',1,0,'C');
$pdf->Cell(25,10,'TANGGAL PENGADUAN',1,0,'C');
$pdf->Cell(25,10,'TANGGAL TANGGAPAN',1,0,'C');
$pdf->Cell(50,10,'NAMA PETUGAS',1,1,'C');

$pdf->SetFont('Arial','',9);
$no = 1;
$catatan = mysqli_query($koneksi, "SELECT * FROM tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas WHERE level='admin'");
while ($d = mysqli_fetch_array($catatan)) {
    $pdf->Cell(10,10, $no++,1,0,'C');

    // Memeriksa apakah file gambar ada dan bisa diakses
    if (file_exists('../upload/'.$d['foto'])) {
        $pdf->Image('../upload/'.$d['foto'], $pdf->GetX() + 12, $pdf->GetY() + 2, 32, 0);
    } else {
        $pdf->Cell(45,10, 'Foto tidak tersedia',1,0,'C');
    }
    
    // Tambahkan teks dalam cel untuk menghindari tumpang tindih dengan gambar
    $pdf->Cell(45,10, '',0); // Spasi kosong setelah gambar
    $pdf->Cell(60,10, $d['isi_laporan'],1,0,'L');  
    $pdf->Cell(50,10, $d['tanggapan'],1,0,'L');
    $pdf->Cell(25,10, $d['tgl_pengaduan'],1,0,'C');
    $pdf->Cell(25,10, $d['tgl_tanggapan'],1,0,'C');
    $pdf->Cell(50,10, $d['nama_petugas'],1,1,'C');
}

$pdf->Output();
?>
