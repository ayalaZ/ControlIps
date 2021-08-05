<?php 
include ("_core.php");
$requestData= $_REQUEST;
require('ssp.customized.class.php' );
// DB table to use
$table= 'usuarios';

$primaryKey = 'id_usuario';

$sql_details = array(
    'user' => $usuario,
    'pass' =>$contraseña,
    'db'   => $basededatos,
    'host' => $servidor
   );

$joinQuery=" FROM usuarios AS u LEFT JOIN tipos_usuario AS t ON (u.id_tipo = t.id_tipo)";

    $extraWhere="";


$columns = array(
    array( 'db' => 'u.id_usuario', 'dt' => 0, 'field' => 'id_usuario' ),
    array( 'db' => 'u.usuario', 'dt' => 1, 'field' => 'usuario' ),
    array( 'db' => 't.tipo_usuario', 'dt' => 2, 'field' => 'tipo_usuario' ),
    array( 'db' => 'id_usuario','dt' => 3,
    'formatter' => function($id_usuario, $row)
    {
        
       $menudrop="<div class='btn-group'>
        <button class='btn btn-primary btn-xl btn-block dropdown-toggle' data-toggle='dropdown'>
            <i class=\"fa fa-gears (alias)\"></i> Acciones <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>";

            $menudrop.="<li><a data-toggle='modal' data-target='#modal3' data-refresh='true' href='permisos.php?id=".$id_usuario."'><i class='glyphicon glyphicon-lock'></i> Permisos</a></li>";

            $menudrop.="<li><a data-toggle='modal' data-target='#modal3' data-refresh='true' href='editar_usuario.php?id=".$id_usuario."'><i class='entypo-pencil'></i> Modificar</a></li>";
        
            $menudrop.="<li><a id_usuario='".$id_usuario."' class='elim'><i class='entypo-trash'></i> Eliminar</a></li>";

                                  
        $menudrop.="</ul>
        </div>";
    return $menudrop;}, 'field' => 'id_usuario')
    );
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );
