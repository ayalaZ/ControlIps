<?php
include('_core.php');
function initial()
{
    include('header.php');
?>
    <h2>Añadir usuario</h2>
    <div class="panel-primary">
        <div class="panel-body">
            <form role='form' id="form9" method="POST">
                <div class="form-group col-sm-12">
                    <label for="usuario" class="control-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" autocomplete="off">
                </div>
                <div class="form-group col-sm-12">
                    <label for="Clave" class="control-label">Clave</label>
                    <input type="password" class="form-control" id="clave" name="clave" placeholder="********" autocomplete="off">
                </div>
                <div class="form-group col-sm-12">
                    <label for="permisos" class="control-label">Tipo de usuario</label>
                    <select name="permisos" id="permisos" class="form-control">
                        <option value="">Seleccione que tipo de usuario sera</option>
                        <?php
                        $sql = _query("SELECT * FROM tipos_usuario");
                        $items = _num_rows($sql);
                        for ($i = 0; $i < $items; $i++) {
                            $row = _fetch_array($sql);
                            echo "<option value='" . $row['id_tipo'] . "'>" . $row['tipo_usuario'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <input type="hidden" name="process" id="process" value="insertusuario">
                                <button type="submit" class="btn btn-lg btn-danger">Agregar</button>
                                <button type="reset" class="btn btn-lg btn-danger">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br />
    <div class="row" id="tablausuarios" name="tablausuarios">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">Usuarios agregados</div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable datatable" id="tabla3" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Permisos</th>
                                    <th>ACCION</th>
                                </tr>
                                <thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='modal fade' id='modal3' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
    echo "<script src='js/funciones_usuarios.js'></script>";
}
function insert()
{
    $usuario = $_POST['usuario'];
    $clave = md5($_POST['clave']);
    $tipo = $_POST['permisos'];
    $table = 'usuarios';
    $data_usuarios = array(
        'usuario' => $usuario,
        'id_tipo' => $tipo,
        'clave' => $clave,
    );
    $sql_prueba = _query("SELECT * FROM usuarios WHERE usuario='$usuario'");
    $dato_existente = _num_rows($sql_prueba);
    if ($dato_existente > 0) {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Ya existe ese usuario';
    } else {
        $insert = _insert($table, $data_usuarios);
        if ($insert) {
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'El usuarios fue registrado con exito';
        } else {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo ingresar el usuario! :(' . _error();
        }
    }
    echo json_encode($xdatos);
}
function eliminarusuario()
{
    $idu = $_POST["id_usuario"];
    $admin = $_SESSION["admin"];
    $propio = $_SESSION["id_usuario"];
    if ($admin != 4) {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'No tiene permisos para eliminar usuarios';
    } else {
        if ($idu == $propio) {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No puede eliminar su propio usuario';
        } else {
            $delete = _query("DELETE FROM usuarios WHERE id_usuario='$idu'");
            if ($delete) {
                $xdatos['typeinfo'] = 'success';
                $xdatos['msg'] = 'Usuarios eliminado correctamente';
            } else {
                $xdatos['typeinfo'] = 'error';
                $xdatos['msg'] = 'No se pudo eliminar el usuario! :(' . _error();
            }
        }
    }
    echo json_encode($xdatos);
}
function permisos()
{
    $idu = $_POST['id_usuario'];
    $tipo = $_POST['permisos'];
    $sql_prueba = _query("SELECT * FROM usuarios WHERE id_usuario='$idu' AND id_tipo='$tipo'");
    $dato_existente = _num_rows($sql_prueba);
    if ($dato_existente > 0) {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Este usuario ya tiene los permisos que trata de asignarle';
    } else {
        $updatepermisos = _query("UPDATE usuarios SET id_tipo='$tipo' WHERE id_usuario='$idu'");
        if ($updatepermisos) {
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'Se le asignaron los permisos correctamente';
        } else {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo asignar los permisos seleccionados! :(' . _error();
        }
    }
    echo json_encode($xdatos);
}
function editar_usuario()
{
    $idu = $_POST["id_usuario"];
    $usuario = $_POST["usuario"];
    $clave = md5($_POST["clave"]);
    $sql_prueba = _query("SELECT * FROM usuarios WHERE usuario='$usuario' AND id_usuario!='$idu'");
    $dato_existente = _num_rows($sql_prueba);
    $table = 'usuarios';
    $data_usuarios = array(
        'usuario' => $usuario,
        'clave' => $clave,
    );
    $where_clausee = "id_usuario='" . $idu . "'";
    if ($dato_existente > 0) {
        $xdatos['typeinfo'] = 'error';
        $xdatos['msg'] = 'Ya existe ese usuario';
    } else {
        $updateusuario = _update($table, $data_usuarios, $where_clausee);
        if ($updateusuario) {
            $xdatos['typeinfo'] = 'success';
            $xdatos['msg'] = 'Se modifico el usuario correctamente';
        } else {
            $xdatos['typeinfo'] = 'error';
            $xdatos['msg'] = 'No se pudo modificar el usuario seleccionado! :(' . _error();
        }
    }
    echo json_encode($xdatos);
}
if (!isset($_POST['process'])) {
    initial();
} else {
    if (isset($_POST['process'])) {
        switch ($_POST['process']) {
            case 'insertusuario':
                insert();
                break;
            case 'asignarpermisos':
                permisos();
                break;
            case 'editusuario':
                editar_usuario();
                break;
            case 'elim_usuario':
                eliminarusuario();
                break;
        }
    }
}
?>