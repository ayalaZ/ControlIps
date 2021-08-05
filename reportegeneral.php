<?php
include('_core.php');
include('header.php');
?>
<div class="row" id="opciones" name="opcioes">
    <div class="col-md-12">
        <div class="panel panel-default panel-shadow" datal-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">Seleccione el tipo de reporte </div>
            </div>
            <div class="panel-body">
                <div class="form-group col-sm-12" id="opcion1" name="opcion1">
                    <label for="tipo" class="control-label">Tipo de reporte</label>
                    <select class="selectpicker form-control" id="tipo" name="tipo">
                        <option>Seleccione tipo de reporte</option>
                        <option value="1">Torres</option>
                        <option value="2">Ap´s</option>
                        <option value="3">Ip´s</option>
                        <option value="4">Asignaciones</option>
                        <option value="5">Usuarios</option>
                    </select>
                </div>
                <div class="form-group col-sm-12" id="opcion2" name="opcion2">
                    <label for="opcion2" class="control-label">Torre</label>
                    <select class="selectpicker form-control" id="torre" name="torre">
                        <option value="0">Todas</option>
                        <?php
                        $torres = "SELECT * FROM torres";
                        $resultados = _query($torres);
                        $items = _num_rows($resultados);
                        for ($i = 0; $i < $items; $i++) {
                            $row = _fetch_array($resultados);
                            $id = $row['id_torre'];
                            $menu = $row['nombre_torre'];
                            echo "<option value=" . $id . ">" . $menu . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-12" id="opcion3" name="opcion3">
                    <label for="opcion2" class="control-label">Ap</label>
                    <select class="selectpicker form-control" id="ap" name="ap" data-live-search="true">
                        <option value="0">Todas</option>
                       <?php
                        $torres = "SELECT * FROM ap ORDER BY id_torre";
                        $resultados = _query($torres);
                        $items = _num_rows($resultados);
                        for ($i = 0; $i < $items; $i++) {
                            $row = _fetch_array($resultados);
                            $id = $row['id_ap'];
                            $menu = $row['nombre_ap'];
                            echo "<option value=" . $id . ">" . $menu . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <button type="submit" id="generar" name="generar" class="btn btn-lg btn-danger mb-2">Generar reporte</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
echo "<script src='js/funciones_reportes.js'></script>";
?>