<?php
include('_core.php');
include('plantilla.php');
$torre = $_SESSION['torre'];
$primeraparte = "SELECT i.id_ip, a.codigo_cliente, a.nombre, i.ip, ap.nombre_ap, e.estado FROM ips AS i LEFT JOIN asignaciones AS a ON (i.id_ip = a.id_ip) LEFT JOIN estados_ip AS e ON (i.id_estadoip = e.id_estadoip) LEFT JOIN ap AS ap ON (a.id_ap = ap.id_ap) WHERE";
if($torre == '1' || $torre == '2'){
    $extraWhere="i.id_torre = '1' OR i.id_torre = '2'";
}elseif($torre == '4' || $torre == '5'){
    $extraWhere="i.id_torre = '4' OR i.id_torre = '5'";
}else{
    $extraWhere="i.id_torre = '$torre'";
}
$completo = $primeraparte." ".$extraWhere;
$sql = $completo;
$sql = _query($completo);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10,6,'#',1,0,'C',1);
$pdf->Cell(20,6,'Codigo',1,0,'C',1);
$pdf->Cell(70,6,'Nombre',1,0,'C',1);
$pdf->Cell(30,6,'Ip',1,0,'C',1);
$pdf->Cell(30,6,'Ap',1,0,'C',1);
$pdf->Cell(30,6,'Estado',1,1,'C',1);

$pdf->SetFont('Arial','',10);

while ($dato = $sql->fetch_assoc()) {
    $pdf->Cell(10,6,utf8_decode($dato['id_ip']),1,0,'C');
    $pdf->Cell(20,6,utf8_decode($dato['codigo_cliente']),1,0,'C');
    $pdf->Cell(70,6,utf8_decode($dato['nombre']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($dato['ip']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($dato['nombre_ap']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($dato['estado']),1,1,'C');
}
/*for ($i=0; $i < $items ; $i++) { 
    $pdf->Cell(10,6,utf8_decode($row['id_ip']),1,0,'C');
    $pdf->Cell(20,6,utf8_decode($row['codigo_cliente']),1,0,'C');
    $pdf->Cell(70,6,utf8_decode($row['nombre']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['ip']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['nombre_ap']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['estado']),1,1,'C');
}*/

$pdf->Output();
?>