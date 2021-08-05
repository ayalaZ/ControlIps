<?php
include('_core.php');
function initial()
{
	include('header.php');
?>
	<h2>Añadir torre</h2>
	<div class="panel-primary">
		<div class="panel-body">
			<form role='form' id="form1" method="POST">
				<div class="form-group col-sm-12">
					<label for="torre" class="control-label">Nombre de Torre</label>
					<input type="text" class="form-control" id="torre" name="torre" data-validate="required" data-message-required="Este dato es requerido." placeholder="Torre" style="text-transform:uppercase;" autocomplete="off">
				</div>
				<div class="form-group col-sm-12">
					<label for="coordenadas" class="control-label">Coordenadas</label>
					<input type="text" class="form-control" id="coordenadas" name="coordenadas" data-validate="required" data-message-required="Este dato es requerido." placeholder="00.0000, -00.0000" data-mask="99.9999,-99.9999" autocomplete="off">
				</div>
				<div class="form-group col-sm-12">
					<label for="aps" class="control-label">Cantidad de ap</label>
					<input type="number" class="form-control" id="aps" name="aps" data-validate="required" data-message-required="Este dato es requerido." placeholder="###" autocomplete="off">
				</div>
				<div class="form-group col-sm-12">
					<label for="cuenta" class="control-label">Cuenta a la que pertenece</label>
					<input type="text" class="form-control" id="cuenta" name="cuenta" data-validate="required" data-message-required="Este dato es requerido." placeholder="CABLEVISION" autocomplete="off">
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-lg-12">
							<div>
								<input type="hidden" name="process" id="process" value="insert">
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
	<div class="row" id="tablatorre" name="tablatorre">
		<div class="col-md-12">
			<div class="panel panel-default panel-shadow" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title">Torres ingresadas</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover table-checkable datatable" id="tabla2" class="display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>TORRE</th>
									<th>Coordenadas</th>
									<th>AP'S</th>
									<th>CUENTA</th>
									<th>ACCION</th>
								</tr>
								<thead>

						</table>
					</div>
				</div>
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
	echo "<script src='js/funciones_torres.js'></script>";
}
function insert()
{
	$torre = strtoupper($_POST['torre']);
	$coordenadas = $_POST['coordenadas'];
	$aps = $_POST['aps'];
	$cuenta =  strtoupper($_POST['cuenta']);
	$sql_prueba = _query("SELECT * FROM torres WHERE nombre_torre='$torre'");
	$table = 'torres';
	$data_torre = array(
		'nombre_torre' => $torre,
		'coordenadas' => $coordenadas,
		'aps' => $aps,
		'cuenta' => $cuenta,
	);
	$dato_existente = _num_rows($sql_prueba);
	if ($dato_existente > 0) {
		$xdatos['typeinfo'] = 'error';
		$xdatos['msg'] = 'Ya existe una torre con ese nombre';
	} else {
		$insert_torre = _insert($table, $data_torre);
		if ($insert_torre) {
			$xdatos['typeinfo'] = 'success';
			$xdatos['msg'] = 'Torre registrada correctamente';
			$xdatos['process'] = 'insert';
		} else {
			$xdatos['typeinfo'] = 'error';
			$xdatos['msg'] = 'No se pudo registra la torre! :(' . _error();
		}
	}
	echo json_encode($xdatos);
}
function eliminartorre()
{
	$id_torre = $_POST['id_torre'];
	$sql_prueba = _query("SELECT *  FROM ips WHERE id_estadoip!=1 AND id_torre='$id_torre'");
	$dato_existente = _num_rows($sql_prueba);
	if ($dato_existente > 0) {
		$xdatos['typeinfo'] = 'error';
		$xdatos['msg'] = 'No se puede eliminar por que esta torre tiene ip asignadas'.$dato_existente;
	} else {
		$sql_prueba2 = _query("SELECT * FROM ap WHERE id_torre='$id_torre'");
		$dato_existente2 = _num_rows($sql_prueba2);
		if ($dato_existente2 > 0) {
			$xdatos['typeinfo'] = 'error';
			$xdatos['msg'] = 'No se puede eliminar por que esta torre tiene ap asignadas';
		} else {
			$delete = _query("DELETE FROM torres WHERE id_torre='$id_torre'");
			$delete = _query("DELETE FROM ips WHERE id_torre='$id_torre'");
			if ($delete) {
				$xdatos['typeinfo'] = 'success';
				$xdatos['msg'] = 'La torre fue eliminado con exito';
				$xdatos['process'] = 'marcar';
			} else {
				$xdatos['typeinfo'] = 'error';
				$xdatos['msg'] = 'No se pudo eliminar la torre! :(' . _error();
			}
		}
	}
	echo json_encode($xdatos);
}
if (!isset($_POST['process'])) {
	initial();
} else {
	if (isset($_POST['process'])) {
		switch ($_POST['process']) {
			case 'insert':
				insert();
				break;
			case 'elim_torre':
				eliminartorre();
				break;
		}
	}
}
?>