<?php
include('_core.php');
include('plantilla2.php');
$ap = $_REQUEST['a'];
if($ap == 0){
    $sql=_query("SELECT * FROM asignaciones AS a LEFT JOIN ap AS ap ON (a.id_ap = ap.id_ap) LEFT JOIN torres AS t ON (ap.id_torre = t.id_torre) LEFT JOIN ips as i ON (a.id_ip = i.id_ip) ORDER BY a.id_asignacion");
}else{
    $sql=_query("SELECT * FROM asignaciones AS a LEFT JOIN ap AS ap ON (a.id_ap = ap.id_ap) LEFT JOIN torres AS t ON (ap.id_torre = t.id_torre) LEFT JOIN ips as i ON (a.id_ip = i.id_ip) WHERE ap.id_ap='$ap' ORDER BY a.id_asignacion");
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



$pdf->Cell(30);
$pdf->Cell(120, 10, 'REPORTE DE IPS ASIGNADAS', 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10,6,'#',1,0,'C',1);
$pdf->Cell(20,6,'Codigo',1,0,'C',1);
$pdf->Cell(60,6,'Nombre',1,0,'C',1);
$pdf->Cell(40,6,'Ip',1,0,'C',1);
$pdf->Cell(30,6,'Ap',1,0,'C',1);
$pdf->Cell(30,6,'Torre',1,1,'C',1);

$pdf->SetFont('Arial','',10);

while ($dato = $sql->fetch_assoc()) {
    $pdf->Cell(10,6,utf8_decode($dato['id_asignacion']),1,0,'C');
    $pdf->Cell(20,6,utf8_decode($dato['codigo_cliente']),1,0,'C');
    $pdf->Cell(60,6,utf8_decode($dato['nombre']),1,0,'C');
    $pdf->Cell(40,6,utf8_decode($dato['ip']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($dato['nombre_ap']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($dato['nombre_torre']),1,1,'C');
}

$pdf->Output();
?>