<?php
$nama = $_GET['printnama'];
$jumlah =$_GET['printtambahan'];
$tanggal = $_GET['printtanggal'];
$idus = $_GET['printidu'];
$keseluruhan = $_GET['printkeseluruhan'];
//$status = $_GET['printstatus'];
$menjadi = $_GET['printmenjadi'];
$namaadmin = $_GET['namaadmin'];
require 'func.php';
$idc = $_GET['printid'];
date_default_timezone_set("Asia/Makassar");
$today = date("G:i:s T D j M Y");


require('fpdf.php');

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial', '', 12);

$pdf->Image('img/logo.png',95,5,20,0,'PNG');
$pdf->Cell(69, 6, '', 0, 0);
$pdf->Cell(95, 60, 'MASLAHAT AR-RHAUDAH', 100, 0);

$pdf->Ln(40);
$pdf->Cell(25, 6, 'ID Cicilan', 0, 0);
$pdf->Cell(25, 6, ': '. $idc, 0, 0);
$pdf->Cell(25, 6, 'Date', 0, 0);
$pdf->Cell(52, 6, ': '. $today , 0, 1);

$pdf->Cell(25, 5, 'Channel', 0, 0);
$pdf->Cell(25, 5, ': WEB', 0, 0);

$pdf->Cell(25, 5, 'Status', 0, 0);
$pdf->Cell(52, 5, ': Success', 0, 1);

$pdf->Line(10, 65, 200, 65);

$pdf->Ln(10);
$pdf->Cell(55, 5, 'Id Peminjam', 0, 0);
$pdf->Cell(58, 5, ': '. $idus , 0, 1);

$pdf->Cell(55, 5, 'Tambahan Pinjaman', 0, 0);
$pdf->Cell(58, 5, ': Rp. '. $jumlah.',-', 0, 1);

$pdf->Cell(55, 5, 'Pinjaman Menjadi', 0, 0);
$pdf->Cell(58, 5, ': Rp. '. $menjadi.',-', 0, 1);

$pdf->Cell(55, 5, 'Pinjaman Keseluruhan', 0, 0);
$pdf->Cell(58, 5, ': Rp. '. $keseluruhan.',-', 0, 1);

$pdf->Cell(55, 5, 'Tanggal Pembayaran', 0, 0);
$pdf->Cell(58, 5, ': '. $tanggal, 0, 1);

$pdf->Line(10, 105, 200, 105);

$pdf->Ln(3);//Line break
$pdf->Cell(55, 5, 'Added for', 0, 0);
$pdf->Cell(58, 5, ': '. $nama, 0, 1);

$pdf->Line(155, 115, 195, 115);
$pdf->Ln(5);//Line break
$pdf->Cell(140, 5, '', 0, 0);
$pdf->Cell(50, 5, ': Signature', 0, 1, 'C');


$pdf->Image('img/stempel.png',155,118,25,0,'PNG');

$pdf->Ln(25);//Line break
$pdf->Cell(140, 5, '', 0, 0);
$pdf->Cell(50, 5, $namaadmin, 0, 1, 'C');


$pdf->Output();
?>