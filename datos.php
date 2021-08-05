<?php
include('_core.php');
function initial()
{
    include('header.php');
    $idtorre =  $_REQUEST['t'];
    $_SESSION["torre"] = $idtorre;
    $sql_torre = _query("SELECT * FROM  torres WHERE id_torre = '$idtorre'");
    $datos = _fetch_array($sql_torre);
    $idtorre = $datos['id_torre'];
    $nombre = $datos['nombre_torre'];
    $coordenas = $datos['coordenadas'];
    $aps = $datos['aps'];
    $cuenta = $datos['cuenta'];
    $_SESSION['nombret'] = $nombre;

?>
    <h2><?php echo $nombre ?></h2>
    <p><?php echo $coordenas ?></p>
    <div class="row">
        <button class="btn btn-lg btn-default" id="plus" name="plus"><i class="entypo-plus"></i></button>
        <button class="btn btn-lg btn-default" id="plus2" name="plus2"><i class="entypo-globe"></i></button>
        <button class="btn btn-lg btn-default" id="editar" name="editar"><i class="entypo-pencil"></i></button>
        <button class="btn btn-lg btn-default" id="reporte" name="reporte"><i class="entypo-doc-text"></i></button>
    </div>
    <br>
    <div class="row" id="plusap" name="plusap">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" datal-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">Panel para agregar una nueva Ap</div>
                </div>
                <div class="panel-body">
                    <form method="POST" role="form" id="form2">
                        <div class="form-group col-sm-12">
                            <label for="nombreap" class="control-label">Nombre de Ap</label>
                            <input type="text" class="form-control" id="nombreap" name="nombreap" placeholder="Nombre de Ap" style="text-transform:uppercase;" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="nombreap" class="control-label">Frecuencia</label>
                            <input type="number" class="form-control" id="frecuencia" name="frecuencia" placeholder="####" autocomplete="off">
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <input type="hidden" name="process" id="process" value="insertap">
                                        <input type="hidden" name="torre" id="torre" value="<?php echo $idtorre; ?>">
                                        <button type="submit" class="btn btn-lg btn-danger mb-2">Guardar</button>
                                        <button type="reset" class="btn btn-lg btn-danger mb-2">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="plusip" name="plusip">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">Panel para agregar un nuevo segmento de ips</div>
                </div>
                <div class="panel-body">
                    <form method="POST" role="form" id="form3">
                        <div class="form-group col-sm-6">
                            <label for="segmento" class="control-label">Ingrese la primer ip de tu segmento</label>
                            <input type="text" class="form-control" id="segmento" name="segmento" placeholder="Segmento" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="cantidad" class="control-label">Cantidad de ip´s</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" max='255' min="1">
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <input type="hidden" name="process" id="process" value="insertsegmento">
                                        <input type="hidden" name="torre" id="torre" value="<?php echo $idtorre; ?>">
                                        <button type="submit" class="btn btn-lg btn-danger mb-2">Guardar</button>
                                        <button type="reset" class="btn btn-lg btn-danger mb-2">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="editartorre" name="editartorre">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">Panel para editar informacion de la torre</div>
                </div>
                <div class="panel-body">
                    <form method="POST" role="form" id="form4">
                        <div class="form-group col-sm-12">
                            <label for="torre" class="control-label">Nombre de Torre</label>
                            <input type="text" class="form-control" id="torre" name="torre" value="<?php echo $nombre ?>" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="coordenadas" class="control-label">Coordenadas</label>
                            <input type="text" class="form-control" id="coordenadas" name="coordenadas" data-mask="99.9999,-99.9999" value="<?php echo $coordenas ?>" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="aps" class="control-label">Cantidad de ap</label>
                            <input type="number" class="form-control" id="aps" name="aps" value="<?php echo $aps ?>" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="cuenta" class="control-label">Cuenta a la que pertenece</label>
                            <input type="text" class="form-control" id="cuenta" name="cuenta" value="<?php echo $cuenta ?>" autocomplete="off">
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <input type="hidden" name="process" id="process" value="edit">
                                        <input type="hidden" name="id_torre" id="id_torre" value="<?php echo $idtorre; ?>">
                                        <button type="submit" class="btn btn-lg btn-danger">Modificar</button>
                                        <button type="reset" class="btn btn-lg btn-danger">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="tablaip" name="tablaip">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">Ip's asignada a esta torre</div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable datatable" id="tabla1" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                    <th>IP</th>
                                    <th>AP</th>
                                    <th>ESTADO</th>
                                    <th>ACCION</th>
                                </tr>
                                <thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='modal fade' id='modal1' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-xl'>
            <div class='modal-content '>

            </div>
        </div>
    </div>
<?php
    echo "<script src='assets/js/jquery.inputmask.bundle.js'></script>";
    include('footer.php');
    echo "<script src='js/datos.js'></script>";
}
function insertap()
{   $nombreap = strtoupper($_POST['nombreap']);
    $torre = $_POST['torre'];
    $frecuencia = $_POST['frecuencia'];
    $sql_prueba = _query("SELECT * FROM ap WHERE nombre_ap = '$nombreap'");
    $table = "ap";
    $data_ap = array(
        'nombre_ap' => $nombreap,
        'id_torre' => $torre,
        'frecuencia' => $frecuencia,
    );
    $dato_existente = _num_rows($sql_prueba);
    if ($dato_existente > 0) {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Ya existe una ap con ese nombre';
    } else {
        $insert_ap = _insert($table, $data_ap);
        if ($insert_ap) {
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'Ap registrada correctamente';
            $xdatos['process'] = 'insertap';
        } else {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo registra la Ap! :(' . _error();
        }
    }
    echo json_encode($xdatos);
}

function insertsegmento()
{
    $segmento = $_POST['segmento'];
    $cantidad = $_POST['cantidad'];
    $torre = $_POST['torre'];
    $ip = array();
    $estadosip = array();
    $interruptor = false;
    $ingresos = 0;
    $table = "ips";
    $segmento = ip2long($segmento);
    for ($i = 0; $i < $cantidad; $i++) {
        $ip[$i] = $segmento;
        $segmento = $segmento + 1;
    }
    for ($i = 0; $i < $cantidad; $i++) {
        $ip_prueba = long2ip($ip[$i]);
        $sql_prueba = _query("SELECT * FROM ips WHERE ip='$ip_prueba'");
        $dato_existente = _num_rows($sql_prueba);
        if ($dato_existente > 0) {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'ip ' . long2ip($ip[$i]) . " ya existe, revise su segmento";
            $interruptor = true;
            break;
        }
    }
    if ($interruptor == false) {
        for ($i = 0; $i < $cantidad; $i++) {
            $data_ip = array(
                'ip' => long2ip($ip[$i]),
                'id_torre' => $torre,
                'id_estadoip' => 1,
            );
            $insert_ip = _insert($table, $data_ip);
            if ($insert_ip) {
                $ingresos = $ingresos + 1;
            } else {
                $xdatos['typeinfo'] = 'error';
                $xdatos['msg'] = 'No se pudo registra la Ip! ' . $ip[$i] . ' :(' . _error();
                break;
            }
        }
    }
    if ($ingresos == $cantidad) {
        $xdatos['typeinfo'] = 'success';
        $xdatos['msg'] = 'Todas las ip´s se registraron correctamente';
        $xdatos['process'] = 'insertsegmento';
    }
    echo json_encode($xdatos);
}
function editartorre()
{
    $torre = strtoupper($_POST['torre']);
    $coordenadas = $_POST['coordenadas'];
    $aps = $_POST['aps'];
    $cuenta = $_POST['cuenta'];
    $id_torre = $_POST['id_torre'];
    $sql_prueba = _query("SELECT * FROM torres WHERE nombre_torre='$torre' AND id_torre != '$id_torre'");
    $table = 'torres';
    $data_torre = array(
        'nombre_torre' => $torre,
        'coordenadas' => $coordenadas,
        'aps' => $aps,
        'cuenta' => $cuenta,
    );
    $where_clausee = "id_torre='" . $id_torre . "'";
    $dato_existente = _num_rows($sql_prueba);
    if ($dato_existente > 0) {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Ya existe una torre con ese nombre';
    } else {
        $update_torre = _update($table, $data_torre, $where_clausee);
        if ($update_torre) {
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'Torre modificada correctamente';
            $xdatos['process'] = 'insert';
        } else {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo modificar la torre! :(' . _error();
        }
    }
    echo json_encode($xdatos);
}
function asignar_ip()
{
    $codigo = $_POST['codigo_cliente'];
    $nombre = strtoupper($_POST['nombre_cliente']);
    $ap = $_POST['ap'];
    $id_ip = $_POST['id_ip'];
    $sql_prueba = _query("SELECT id_estadoip FROM ips WHERE id_ip = '$id_ip' AND id_estadoip != '1'");
    $sql_prueba2 = _query("SELECT codigo_cliente FROM asignaciones WHERE codigo_cliente='$codigo'");
    $table1 = 'asignaciones';
    $table2 = 'ips';
    $where = "id_ip='" . $id_ip . "'";
    $data_estado = array(
        'id_estadoip' => 2,
    );
    $data_asignacion = array(
        'codigo_cliente' => $codigo,
        'nombre' => $nombre,
        'id_ip' => $id_ip,
        'id_ap' => $ap,
    );
    $dato_existente = _num_rows($sql_prueba);
    if ($dato_existente > 0) {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'La ip ya ha sido asignada o el cliente ya tiene una ip asignada';
    } else {
       $dato_existente2 = _num_rows($sql_prueba2);
       if($dato_existente2 > 0){
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'Ya existe una ip asignada a ese codigo';
       }else{
        $asignacion_ip = _insert($table1, $data_asignacion);
        if ($asignacion_ip) {
            $updateestado = _update($table2, $data_estado, $where);
            if ($updateestado) {
                $xdatos['typeinfo'] = 'success';
                $xdatos['msg'] = 'Ip asignada correctamente al cliente';
                $xdatos['process'] = 'asignar';
            } else {
                $xdatos['typeinfo'] = 'warning';
                $xdatos['msg'] = 'Ip asignada correctamente pero no se pudo cambiar el estado de la ip';
                $xdatos['process'] = 'asignar';
            }
        } else {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo asignar la ip! :(' . _error();
        }
       }
    }
    echo json_encode($xdatos);
}
function liberarip()
{
    $id_ip = $_POST['id_ip'];
    $table1 = 'asignaciones';
    $where = "id_ip='" . $id_ip . "'";
    $table2 = 'ips';
    $data_estado = array(
        'id_estadoip' => 1,
    );
    $sql_prueba = _query("SELECT id_estadoip FROM ips WHERE id_ip = '$id_ip' AND id_estadoip != '1'");
    $dato_existente = _num_rows($sql_prueba);
    if ($dato_existente > 0) {
        $liberar = _update($table2, $data_estado, $where);
        if ($liberar) {
            $liberar2 = _delete($table1, $where);
            if ($liberar2) {
                $xdatos['typeinfo'] = 'success';
                $xdatos['msg'] = 'Ip libre para ocupar con otro cliente';
            } else {
                $xdatos['typeinfo'] = 'warning';
                $xdatos['msg'] = 'Se cambio el estado de la ip pero no se pudo borrar los datos del cliente';
            }
        } else {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo liberar la ip! :(' . _error();
        }
    } else {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Esa ip ya esta en estado libre! :(' . _error();
    }
    echo json_encode($xdatos);
}
function reserva_ip(){
    $codigo = 'N/A';
    $nombre = 'N/A';
    $ap = $_POST['ap'];
    $id_ip = $_POST['id_ip'];
    $sql_prueba = _query("SELECT id_estadoip FROM ips WHERE id_ip = '$id_ip' AND id_estadoip != '1'");
    $table1 = 'asignaciones';
    $table2 = 'ips';
    $where = "id_ip='" . $id_ip . "'";
    $data_estado = array(
        'id_estadoip' => 3,
    );
    $data_asignacion = array(
        'codigo_cliente' => $codigo,
        'nombre' => $nombre,
        'id_ip' => $id_ip,
        'id_ap' => $ap,
    );
    $dato_existente = _num_rows($sql_prueba);
    if ($dato_existente > 0) {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Esa ip ya esta siendo utilizada';
    } else {
        $asignacion_ip = _insert($table1, $data_asignacion);
        if ($asignacion_ip) {
            $updateestado = _update($table2, $data_estado, $where);
            if ($updateestado) {
                $xdatos['typeinfo'] = 'success';
                $xdatos['msg'] = 'Ip asignada correctamente al equipo';
                $xdatos['process'] = 'asignar';
            } else {
                $xdatos['typeinfo'] = 'warning';
                $xdatos['msg'] = 'Ip asignada correctamente pero no se pudo cambiar el estado de la ip';
                $xdatos['process'] = 'asignar';
            }
        } else {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo asignar la ip! :(' . _error();
        }
    }
    echo json_encode($xdatos);
}
function no_asignar(){
    $id_ip = $_POST['id_ip'];
    $sql_prueba = _query("SELECT * FROM asignaciones WHERE id_ip='$id_ip'");
    $dato_existente = _num_rows($sql_prueba);
    if($dato_existente){
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Esa ip ya esta siendo utilizada';
    }else{
        $sql_prueba2 = _query("SELECT * FROM ips WHERE id_ip='$id_ip' AND id_estadoip='4'");
        $dato_existente2 = _num_rows($sql_prueba2);
        if($dato_existente2 > 0){
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'Esa ip ya esta marcada para no utilizar';
        }else{
            $updateestado = _query("UPDATE ips SET id_estadoip='4' WHERE id_ip='$id_ip'");
            if($updateestado){
                $xdatos['typeinfo'] = 'success';
                $xdatos['msg'] = 'Ip ha sido marcada para no utilizar';
                $xdatos['process'] = 'marcar';
            }
            else{
                $xdatos['typeinfo'] = 'error';
                $xdatos['msg'] = 'No se pudo marcar la ip! :(' . _error();
            }
        }
    }
    echo json_encode($xdatos);
}
function editar_ip(){
    $codigo = $_POST['codigo_cliente'];
    $nombre = strtoupper($_POST['nombre_cliente']);
    $ap = $_POST['ap'];
    $id_ip = $_POST['id_ip'];
    $sql_prueba = _query("SELECT * FROM asignaciones WHERE codigo_cliente='$codigo' AND id_ip='$id_ip' AND nombre='$nombre'");
    $dato_existente = _num_rows($sql_prueba);
    if($dato_existente > 0){
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Ya existe una ip asignada a ese codigo';
    }else{
        $updatecliente = _query("UPDATE asignaciones SET codigo_cliente='$codigo', nombre='$nombre', id_ap='$ap' WHERE id_ip='$id_ip'");
        if($updatecliente){
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'Los datos han sido modificados correctamente';
            $xdatos['process'] = 'marcar';
        }else{
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo modificar los datos! :(' . _error();
        }
    }

    echo json_encode($xdatos);
}
function eliminar_ip(){
    $id_ip = $_POST['id_ip'];
    $sql_prueba = _query("SELECT *  FROM ips WHERE id_ip='$id_ip' AND id_estadoip != '1'");
    $dato_existente = _num_rows($sql_prueba);
    if($dato_existente > 0){
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'No se puede eliminar la ip por que esta siendo ocupada primero debe liberar la ip';
    }else{
        $delete = _query("DELETE FROM ips WHERE id_ip='$id_ip'");
        if($delete){
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'La ip se ha eliminado correctamente';
            $xdatos['process'] = 'marcar';
        }else{
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo eliminar la ip! :(' . _error();
        }
    }
    echo json_encode($xdatos);
}
if (!isset($_POST['process'])) {
    initial();
} else {
    if (isset($_POST['process'])) {
        switch ($_POST['process']) {
            case 'insertap':
                insertap();
                break;
            case 'insertsegmento':
                insertsegmento();
                break;
            case 'edit':
                editartorre();
                break;
            case 'asignar':
                asignar_ip();
                break;
            case 'lib_ip':
                liberarip();
                break;
            case 'reservar':
                reserva_ip();
                break;
            case 'no_ip':
                no_asignar();
            break;
            case 'editarip':
                editar_ip();
            break;
            case 'elim_ip':
                eliminar_ip();
                break;
        }
    }
}
?>