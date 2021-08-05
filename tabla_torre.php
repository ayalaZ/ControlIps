<?php 
include ("_core.php");
$requestData= $_REQUEST;
require('ssp.customized.class.php' );
// DB table to use
$table= 'torres';

$primaryKey = 'id_torre';

$sql_details = array(
    'user' => $usuario,
    'pass' =>$contraseña,
    'db'   => $basededatos,
    'host' => $servidor
   );

$joinQuery="";

    $extraWhere="";


$columns = array(
    array( 'db' => 'id_torre', 'dt' => 0, 'field' => 'id_torre' ),
    array( 'db' => 'nombre_torre', 'dt' => 1, 'field' => 'nombre_torre' ),
    array( 'db' => 'coordenadas', 'dt' => 2, 'field' => 'coordenadas' ),
    array( 'db' => 'aps', 'dt' => 3, 'field' => 'aps' ),
    array( 'db' => 'cuenta', 'dt' => 4, 'field' => 'cuenta' ),
    array( 'db' => 'id_torre','dt' => 5,
    'formatter' => function($id_torre, $row)
    {
        
       $menudrop="<div class='btn-group'>
        <button class='btn btn-primary btn-xl dropdown-toggle' data-toggle='dropdown'>
            <i class=\"fa fa-gears (alias)\"></i> Acciones <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>";
        
            $menudrop.="<li><a id_torre='".$id_torre."' class='elim'><i class='entypo-trash'></i> Eliminar</a></li>";

                                  
        $menudrop.="</ul>
        </div>";
    return $menudrop;}, 'field' => 'id_torre')
    );
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

?>