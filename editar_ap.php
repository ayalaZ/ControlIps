<?php
include("_core.php");
$idap = $_REQUEST['id'];
$sql = _query("SELECT * FROM ap WHERE id_ap='$idap'");
$datos = _fetch_array($sql); 
?>
<div class="modal-header" style="background-color: #343a40;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" style="color: white;">Panel para modificar la ap seleccionada</h4>
</div>
<div class="modal-body">
    <div class="row" id="asignar" name="asignar">
        <div class="col-md-12">
            <form method="POST" role="form" id="form8">
                <div class="form-group col-sm-12">
                    <label for="nombreap" class="control-label">Nombre de Ap</label>
                    <input type="text" class="form-control" id="nombreap" name="nombreap" placeholder="Nombre de Ap" style="text-transform:uppercase;" autocomplete="off" value="<?php echo $datos['nombre_ap']?>">
                </div>
                <div class="form-group col-sm-12">
                    <label for="nombreap" class="control-label">Frecuencia</label>
                    <input type="number" class="form-control" id="frecuencia" name="frecuencia" placeholder="####" autocomplete="off" value="<?php echo $datos['frecuencia'] ?>">
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <input type="hidden" name="process" id="process" value="editap">
                                <input type="hidden" name="torre" id="torre" value="<?php echo $datos['id_torre']?>">
                                <input type="hidden" name="id_ap" id="id_ap" value="<?php echo $idap?>">
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
<script>
    $(document).ready(function() {
        $("#modal2").on('hidden.bs.modal', function() {
            setInterval("refrescar();", 2000);
        });
        $('#form8').validate({
            rules: {
                nombreap:{
                    required:true,
                },
                frecuencia:{
                    required:true,
                },
            },
            messages: {
                nombreap:{
                    required:"Debe ingresar el nombre de la ap",
                },
                frecuencia:{
                    required:"Debe ingresar la frecuencia de la ap"
                },
            },
            submitHandler: function(form) {
                $("#modal2").modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                modificar_ap();
            }
        });
    });

    function recarga() {
        location.reload();
    }

    function refrescar() {
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

    function modificar_ap() {
        var process = $("#process").val();

        if (process == "editap") {
            var url = "aps.php";
        }

        var form = $("#form8");
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        Swal.fire({
            title: "Modificando datos de ap",
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