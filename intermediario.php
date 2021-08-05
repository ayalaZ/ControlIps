<?php 
include('_core.php');
$regreso ="";
$idtorre = $_POST["id"];
if ($idtorre == '1' || $idtorre == '2') {
    $query = "SELECT * FROM ap WHERE id_torre='1' OR id_torre='2'";
} elseif ($idtorre == '4' || $idtorre == '5') {
    $query = "SELECT * FROM ap WHERE id_torre='4' OR id_torre='5'";
} else {
    $query = "SELECT * FROM ap WHERE id_torre='$idtorre'";
}
$sql = _query($query);
$items = _num_rows($sql);
for ($i = 0; $i < $items; $i++) {
    $row = _fetch_array($sql);
    $regreso .= "<option value='" . $row['id_ap'] . "'>" . $row['nombre_ap'] . "</option>";
}
echo json_encode($regreso);
?>