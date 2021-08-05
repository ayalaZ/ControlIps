<?php
include('_core.php');
include('plantilla2.php');
$torre = $_REQUEST['t'];
if($torre == 0){
    $sql=_query("SELECT * FROM ips AS i LEFT JOIN torres AS t ON (i.id_torre = t.id_torre) LEFT JOIN estados_ip AS e ON (i.id_estadoip = e.id_estadoip) ORDER BY i.id_ip");
}else{
    $sql=_query("SELECT * FROM ips AS i LEFT JOIN torres AS t ON (i.id_torre = t.id_torre) LEFT JOIN estados_ip AS e ON (i.id_estadoip = e.id_estadoip) WHERE t.id_torre = '$torre' ORDER BY i.id_ip");
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



$pdf->Cell(30);
$pdf->Cell(120, 10, 'REPORTE DE IPS', 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10,6,'#',1,0,'C',1);
$pdf->Cell(70,6,'Ip',1,0,'C',1);
$pdf->Cell(60,6,'Torre',1,0,'C',1);
$pdf->Cell(50,6,'Estado',1,1,'C',1);

$pdf->SetFont('Arial','',10);

while ($dato = $sql->fetch_assoc()) {
    $pdf->Cell(10,6,utf8_decode($dato['id_ip']),1,0,'C');
    $pdf->Cell(70,6,utf8_decode($dato['ip']),1,0,'C');
    $pdf->Cell(60,6,utf8_decode($dato['nombre_torre']),1,0,'C');
    $pdf->Cell(50,6,utf8_decode($dato['estado']),1,1,'C');
}

$pdf->Output();
?>