<?php
include('_core.php');
function initial()
{
    include('header.php');
?>
    <div class="row" id="tablaap" name="tablaap">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">Ap ingresadas</div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable datatable" id="tabla3" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>AP</th>
                                    <th>FRECUENCIA</th>
                                    <th>TORRE</th>
                                    <th>ACCION</th>
                                </tr>
                                <thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='modal fade' id='modal2' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-xl'>
            <div class='modal-content '>

            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="main">



    </footer>
    </div>
    </div>
<?php
    echo "<script src='assets/js/jquery.inputmask.bundle.js'></script>";
    include('footer.php');
    echo "<script src='js/funciones_ap.js'></script>";
}

function eliminarap(){
    $id_ap = $_POST['id_ap'];
    $table = 'ap';
    $where_clausee = "id_ap='" . $id_ap . "'";
    $sql_prueba = _query("SELECT * FROM asignaciones WHERE id_ap='$id_ap'");
    $dato_existente = _num_rows($sql_prueba);
    if($dato_existente > 0){
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Hay un cliente asignado a esta ap';
    }else{
        $deletedap = _delete($table,$where_clausee);
        if($deletedap){
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'Ap eliminada correctamente';
        }else{
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo eliminar la ap! :(' . _error();
        }
    }
    echo json_encode($xdatos);
}
function editar_ap(){
    $id_ap = $_POST['id_ap'];
    $nombreap = $_POST['nombreap'];
    $frecuencia = $_POST['frecuencia'];
    $torre = $_POST['torre'];
    $table = 'ap';
    $sql_prueba = _query("SELECT * FROM ap WHERE nombre_ap='$nombreap' AND id_ap!='$id_ap'");
    $dato_existente = _num_rows($sql_prueba);
    $data_ap= array(
        'nombre_ap' => $nombreap,
        'frecuencia' => $frecuencia,
        'id_torre' => $torre,
    );
    $where_clausee = "id_ap='" . $id_ap . "'";
    if($dato_existente > 0){
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Ya existe una ap con ese nombre';
    }else{
        $updateap = _update($table,$data_ap,$where_clausee);
        if($updateap){
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'Ap modificada correctamente';
            $xdatos['process'] = 'insert';
        }else{
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo modificar la ap! :(' . _error();
        }
    }   
    echo json_encode($xdatos);
}
if (!isset($_POST['process'])) {
    initial();
} else {
    if (isset($_POST['process'])) {
        switch ($_POST['process']) {
            case 'editap':
                editar_ap();
            break;
            case 'elim_ap':
                eliminarap();
            break;
        }
    }
}
?>