<?php 
    include ("_core.php");
    $requestData= $_REQUEST;
    $torre = $_SESSION["torre"];
    require('ssp.customized.class.php' );
    // DB table to use
    $table= 'ips';

    $primaryKey = 'id_ip';

    $sql_details = array(
        'user' => $usuario,
        'pass' =>$contraseña,
        'db'   => $basededatos,
        'host' => $servidor
       );

    $joinQuery=" FROM ips AS i LEFT JOIN asignaciones AS a ON (i.id_ip = a.id_ip) LEFT JOIN torres AS t ON (i.id_torre = t.id_torre) LEFT JOIN ap AS ap ON (a.id_ap = ap.id_ap) LEFT JOIN estados_ip AS e ON (i.id_estadoip = e.id_estadoip) ";
    if($torre == '1' || $torre == '2'){
        $extraWhere="i.id_torre = '1' OR i.id_torre = '2'";
    }elseif($torre == '4' || $torre == '5'){
        $extraWhere="i.id_torre = '4' OR i.id_torre = '5'";
    }else{
        $extraWhere="i.id_torre = '$torre'";
    }
    
    $columns = array(
        array( 'db' => 'i.id_ip', 'dt' => 0, 'field' => 'id_ip' ),
        array( 'db' => 'a.codigo_cliente', 'dt' => 1, 'field' => 'codigo_cliente' ),
        array( 'db' => 'a.nombre', 'dt' => 2, 'field' => 'nombre' ),
        array( 'db' => 'i.ip', 'dt' => 3, 'field' => 'ip' ),
        array( 'db' => 'ap.nombre_ap', 'dt' => 4, 'field' => 'nombre_ap' ),
        array( 'db' => 'e.estado', 'dt' => 5, 'field' => 'estado' ),
        array( 'db' => 'i.id_ip','dt' => 6,
        'formatter' => function($id_ip, $row)
        {
            
           $menudrop="<div class='btn-group'>
            <button class='btn btn-primary btn-xl dropdown-toggle' data-toggle='dropdown'>
                <i class=\"fa fa-gears (alias)\"></i> Acciones <span class='caret'></span>
            </button>
            <ul class='dropdown-menu'>";
           
                $menudrop.="<li><a data-toggle='modal' data-target='#modal1' data-refresh='true' href='asignar_ip.php?id=".$id_ip."'><i class='glyphicon glyphicon-cloud-upload'></i> Asignar</a></li>";

                $menudrop.="<li><a id_ip='".$id_ip."' class='lib'><i class='glyphicon glyphicon-cloud-download'></i> Liberar</a></li>";

                $menudrop.="<li><a data-toggle='modal' data-target='#modal1' data-refresh='true' href='reservar_ip.php?id=".$id_ip."'><i class='glyphicon glyphicon-tag'></i> Reservar</a></li>";
                
                $menudrop.="<li><a id_ip='".$id_ip."' class='no'><i class='glyphicon glyphicon-ban-circle'></i> No utilizar</a></li>";
                             
                $menudrop.="<li><a data-toggle='modal' data-target='#modal1' data-refresh='true' href='editar_ip.php?id=".$id_ip."'><i class='entypo-pencil'></i> Modificar</a></li>";
            
                $menudrop.="<li><a id_ip='".$id_ip."' class='elim'><i class='entypo-trash'></i> Eliminar</a></li>";

                                      
            $menudrop.="</ul>
            </div>";
        return $menudrop;}, 'field' => 'id_ip')
        );
        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
        );
?>