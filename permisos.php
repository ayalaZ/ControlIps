<?php
include("_core.php");
$idusuario = $_REQUEST['id'];
?>
<div class="modal-header" style="background-color: #343a40;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" style="color: white;">Panel para modificar los permisos de un usuario</h4>
</div>
<div class="modal-body">
    <div class="row" id="asignar" name="asignar">
        <div class="col-md-12">
                <form method="POST" role="form" id="form10">
                    <div class="form-group col-sm-12">
                        <label for="ap" class="control-label">Tipo de permisos</label>
                        <select name="permisos" id="permisos" class="form-control">
                            <option value="">Seleccione el tipo de permisos que le quiere asignar al usuario</option>
                            <?php
                                $query = "SELECT * FROM tipos_usuario";
                            $sql = _query($query);
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
                                    <input type="hidden" name="process" id="process" value="asignarpermisos">
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
        $("#modal3").on('hidden.bs.modal', function () {
            setInterval("refrescar();", 2000);
        });
        $('#form10').validate({
            rules: {
               permisos:{
                   required:true,
               },
            },
            messages: {
               permisos:{
                   required:"Debe seleccionar el tipo de permisos para el usuario",
               },
            },
            submitHandler: function(form) {
                $("#modal3").modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                asignar_permisos();
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
    function asignar_permisos() {
        var process = $("#process").val();

        if (process == "asignarpermisos") {
            var url = "usuarios.php";
        }

        var form = $("#form10");
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        Swal.fire({
            title: "Asignando permisos al usuario",
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