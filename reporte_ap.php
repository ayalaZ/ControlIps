<?php
include('_core.php');
include('plantilla2.php');
$torre = $_REQUEST['t'];
if($torre == 0){
    $sql=_query("SELECT * FROM ap AS a LEFT JOIN torres AS t ON (a.id_torre = t.id_torre) ORDER BY t.nombre_torre");
}else{
    $sql=_query("SELECT * FROM ap AS a LEFT JOIN torres AS t ON (a.id_torre = t.id_torre) WHERE t.id_torre='$torre' ORDER BY t.nombre_torre");
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



$pdf->Cell(30);
$pdf->Cell(120, 10, 'REPORTE DE APS', 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10,6,'#',1,0,'C',1);
$pdf->Cell(70,6,'Nombre',1,0,'C',1);
$pdf->Cell(60,6,'Torre',1,0,'C',1);
$pdf->Cell(50,6,'frecuencia',1,1,'C',1);

$pdf->SetFont('Arial','',10);

while ($dato = $sql->fetch_assoc()) {
    $pdf->Cell(10,6,utf8_decode($dato['id_ap']),1,0,'C');
    $pdf->Cell(70,6,utf8_decode($dato['nombre_ap']),1,0,'C');
    $pdf->Cell(60,6,utf8_decode($dato['nombre_torre']),1,0,'C');
    $pdf->Cell(50,6,utf8_decode($dato['frecuencia']),1,1,'C');
}

$pdf->Output();
?>