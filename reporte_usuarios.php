<?php
include('_core.php');
include('plantilla2.php');
$sql = _query("SELECT * FROM usuarios AS u LEFT JOIN tipos_usuario AS t ON (u.id_tipo = t.id_tipo) ORDER BY usuario");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



$pdf->Cell(30);
$pdf->Cell(120, 10, 'REPORTE DE IPS ASIGNADAS', 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30);
$pdf->Cell(10,6,'#',1,0,'C',1);
$pdf->Cell(60,6,'Usuario',1,0,'C',1);
$pdf->Cell(60,6,'Tipo de usuario',1,1,'C',1);

$pdf->SetFont('Arial','',10);

while ($dato = $sql->fetch_assoc()) {
    $pdf->Cell(30);
    $pdf->Cell(10,6,utf8_decode($dato['id_usuario']),1,0,'C');
    $pdf->Cell(60,6,utf8_decode($dato['usuario']),1,0,'C');
    $pdf->Cell(60,6,utf8_decode($dato['tipo_usuario']),1,1,'C');
   
}

$pdf->Output();
?>