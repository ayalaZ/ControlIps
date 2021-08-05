<?php
include('_core.php');
include('plantilla2.php');

$sql=_query("SELECT * FROM torres ORDER BY id_torre");

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(30);
$pdf->Cell(120, 10, 'REPORTE DE TORRES', 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10,6,'#',1,0,'C',1);
$pdf->Cell(70,6,'Nombre',1,0,'C',1);
$pdf->Cell(40,6,'Coordenadas',1,0,'C',1);
$pdf->Cell(30,6,'Aps',1,0,'C',1);
$pdf->Cell(40,6,'Cuenta',1,1,'C',1);

$pdf->SetFont('Arial','',10);

while ($dato = $sql->fetch_assoc()) {
    $pdf->Cell(10,6,utf8_decode($dato['id_torre']),1,0,'C');
    $pdf->Cell(70,6,utf8_decode($dato['nombre_torre']),1,0,'C');
    $pdf->Cell(40,6,utf8_decode($dato['coordenadas']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($dato['aps']),1,0,'C');
    $pdf->Cell(40,6,utf8_decode($dato['cuenta']),1,1,'C');
}

$pdf->Output();
?>