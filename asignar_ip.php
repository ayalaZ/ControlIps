<?php
include("_core.php");
$idtorre = $_SESSION["torre"];
$idip = $_REQUEST['id'];
$sql_prueba = _query("SELECT id_estadoip FROM ips WHERE id_ip = '$idip' AND id_estadoip != '1'");
$dato_existente = _num_rows($sql_prueba);
?>
<div class="modal-header" style="background-color: #343a40;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" style="color: white;">Panel para asignar una ip a un cliente </h4>
</div>
<div class="modal-body">
    <div class="row" id="asignar" name="asignar">
        <div class="col-md-12">
        <?php
            if ($dato_existente > 0) {
            ?>
                <div class="panel panel-danger" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">Error</div>
                    </div>
                    <div class="panel-body">
                        <p>Esta ip ya ha sido asignada</p>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <form method="POST" role="form" id="form5">
                    <div class="form-group col-sm-12">
                        <label for="codigo_cliente" class="control-label">Codigo del cliente</label>
                        <input type="number" class="form-control" id="codigo_cliente" name="codigo_cliente" placeholder="#####" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="nombre_cliente" class="control-label">Nombre completo del cliente</label>
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre del cliente" style="text-transform:uppercase;" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="ap" class="control-label">Ap a asignar</label>
                        <select name="ap" id="ap" class="form-control">
                            <option value="">Seleccione la ap a la que conectara al cliente</option>
                            <?php
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
                                echo "<option value='" . $row['id_ap'] . "'>" . $row['nombre_ap'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <input type="hidden" name="process" id="process" value="asignar">
                                    <input type="hidden" name="id_ip" id="id_ip" value="<?php echo $idip; ?>">
                                    <button type="submit" class="btn btn-lg btn-danger">Asignar</button>
                                    <button type="reset" class="btn btn-lg btn-danger">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#modal1").on('hidden.bs.modal', function () {
            setInterval("refrescar();", 2000);
        });
        $('#form5').validate({
            rules: {
                codigo_cliente: {
                    required: true,
                },
                nombre_cliente: {
                    required: true,
                },
                ap: {
                    required: true,
                },
            },
            messages: {
                codigo_cliente: {
                    required: "Debe ingresar el codigo del cliente",
                },
                nombre_cliente: {
                    required: "Debe ingresar el nombre del cliente",
                },
                ap: {
                    required: "Debe seleccionar la ap a la que estara conectado el cliente",
                },
            },
            submitHandler: function(form) {
                $("#modal1").modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                asignar_ip();
            }
        });
    });

    function recarga() {
        location.reload();
    }
    function refrescar(){
        Swal.fire({
            title: "Refrescando la pagina",
            text: "Espera un momento",
            type: "info",
            showLoaderOnConfirm: true,
            onOpen: function() {
                Swal.clickConfirm();
            },
            preConfirm: function() {
                return new Promise(function(resolve) {
                    setInterval("recarga();", 2000);
                });
            }
        });
    }
    function asignar_ip() {
        var process = $("#process").val();

        if (process == "asignar") {
            var url = "datos.php";
        }

        var form = $("#form5");
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        Swal.fire({
            title: "Asignando la ip a un cliente",
            text: "Espera un momento",
            type: "info",
            showLoaderOnConfirm: true,
            onOpen: function() {
                Swal.clickConfirm();
            },
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        cache: false,
                        data: formdata ? formdata : form.serialize(),
                        contentType: false,
                        processData: false,
                        dataType: 'json',

                        success: function(datax) {

                            if (datax.typeinfo == "success" || datax.typeinfo == "Success") {
                                setInterval("recarga();", 2000);
                            }
                            swal.closeModal();
                            Swal.fire({
                                icon: datax.typeinfo,
                                title: 'Tu resultado',
                                text: datax.msg,
                            })
                        }
                    });
                });
            },
            allowOutsideClick: false
        });
    }
</script>