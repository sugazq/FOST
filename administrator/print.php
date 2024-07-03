<?php
// memanggil library FPDF

use Fpdf\Fpdf;

require('../fpdf/src/Fpdf/Fpdf.php');

include '../koneksi.php';
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new  Fpdf('l','mm','A4');
$pdf->AddPage();
 
$pdf->SetFont('Times','B',13);
$pdf->Cell(275,10,'DATA PENGADUAN',0,0,'C');
 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,7,'NO',1,0,'C');
$pdf->Cell(50,7,'FOTO' ,1,0,'C');
$pdf->Cell(50,7,'ISI LAPORAN',1,0,'C');
$pdf->Cell(45,7,'ISI TANGGAPAN',1,0,'C');
$pdf->Cell(40,7,'TANGGAL PENGADUAN',1,0,'C');
$pdf->Cell(40,7,'TANGGAL TANGGAPAN',1,0,'C');
$pdf->Cell(42,7,'NAMA PETUGAS',1,0,'C');


 
 
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
$catatan    =mysqli_query($koneksi, "SELECT * FROM tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas where level='admin'");
while($d = mysqli_fetch_array($catatan)){
  $pdf->Cell(10,6, $no++,1,0,'C');
  $pdf->Cell(50,6, $d['foto'],1,0,'C');
  $pdf->Cell(50,6, $d['isi_laporan'],1,0,'C');  
  $pdf->Cell(45,6, $d['tanggapan'],1,0,'C');
  $pdf->Cell(40,6, $d['tgl_pengaduan'],1,0,'C');
  $pdf->Cell(40,6, $d['tgl_tanggapan'],1,0,'C');
  $pdf->Cell(42,6, $d['nama_petugas'],1,1,'C');
}
 
$pdf->Output();
 
?>