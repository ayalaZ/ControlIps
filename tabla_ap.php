<?php 
include ("_core.php");
$requestData= $_REQUEST;
require('ssp.customized.class.php' );
// DB table to use
$table= 'ap';

$primaryKey = 'id_ap';

$sql_details = array(
    'user' => $usuario,
    'pass' =>$contraseña,
    'db'   => $basededatos,
    'host' => $servidor
   );

$joinQuery="FROM ap AS a LEFT JOIN torres AS t on(a.id_torre = t.id_torre)";

    $extraWhere="";


$columns = array(
    array( 'db' => 'a.id_ap', 'dt' => 0, 'field' => 'id_ap' ),
    array( 'db' => 'a.nombre_ap', 'dt' => 1, 'field' => 'nombre_ap' ),
    array( 'db' => 'a.frecuencia', 'dt' => 2, 'field' => 'frecuencia' ),
    array( 'db' => 't.nombre_torre', 'dt' => 3, 'field' => 'nombre_torre' ),
    array( 'db' => 'a.id_ap','dt' => 4,
    'formatter' => function($id_ap, $row)
    {
        
       $menudrop="<div class='btn-group'>
        <button class='btn btn-primary btn-xl dropdown-toggle' data-toggle='dropdown'>
            <i class=\"fa fa-gears (alias)\"></i> Acciones <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>";

            $menudrop.="<li><a data-toggle='modal' data-target='#modal2' data-refresh='true' href='editar_ap.php?id=".$id_ap."'><i class='entypo-pencil'></i> Modificar</a></li>";
        
            $menudrop.="<li><a id_ap='".$id_ap."' class='elim'><i class='entypo-trash (alias)'></i> Eliminar</a></li>";

                                  
        $menudrop.="</ul>
        </div>";
    return $menudrop;}, 'field' => 'id_ap')
    );
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

?>