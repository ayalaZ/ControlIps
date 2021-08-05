<?php
include("_core.php");
$idusuario = $_REQUEST['id'];
$sql = _query("SELECT * FROM usuarios WHERE id_usuario='$idusuario'");
$datos = _fetch_array($sql);
?>
<div class="modal-header" style="background-color: #343a40;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" style="color: white;">Panel para modificar los datos de un usuario</h4>
</div>
<div class="modal-body">
    <div class="row" id="asignar" name="asignar">
        <div class="col-md-12">
            <form method="POST" role="form" id="form11">
                <div class="form-group col-sm-12">
                    <label for="usuario" class="control-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" autocomplete="off" value="<?php echo $datos['usuario'] ?>">
                </div>
                <div class="form-group col-sm-12">
                    <label for="Clave" class="control-label">Clave</label>
                    <input type="password" class="form-control" id="clave" name="clave" placeholder="********" autocomplete="off">
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <input type="hidden" name="process" id="process" value="editusuario">
                                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $idusuario; ?>">
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
<script>
    $(document).ready(function() {
        $("#modal3").on('hidden.bs.modal', function() {
            setInterval("refrescar();", 2000);
        });
        $('#form11').validate({
            rules: {
                usuario: {
                    required: true,
                    minlength: 8,
                    noSpace: true
                },
                clave: {
                    required: true,
                    minlength: 8,
                },
            },
            messages: {
                usuario: {
                    required: "Debe ingresar el usuario",
                    minlength: jQuery.validator.format("se requieren al menos {0} caracteres!")
                },
                clave: {
                    required: "Debe ingresar la clave para este usuario",
                    minlength: jQuery.validator.format("se requieren al menos {0} caracteres!")
                },
            },
            submitHandler: function(form) {
                $("#modal3").modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                editar_usuario();
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

    function editar_usuario() {
        var process = $("#process").val();

        if (process == "editusuario") {
            var url = "usuarios.php";
        }

        var form = $("#form11");
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        Swal.fire({
            title: "Modificando datos de usuario",
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