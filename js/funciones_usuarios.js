$(document).ready(function() {
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
   }, "No deje espacios por favor");

    $('#form9').validate({
        rules:{
            usuario:{
                required:true,
                minlength: 8, 
                noSpace: true
            },
            clave:{
                required:true,
                minlength:8,
            },
            permisos:{
                required: true,
            },
        },
        messages:{
            usuario:{
                required: "Debe ingresar el usuario",
                minlength: jQuery.validator.format("se requieren al menos {0} caracteres!")
            },
            clave:{
                required: "Debe ingresar la clave para este usuario",
                minlength: jQuery.validator.format("se requieren al menos {0} caracteres!")
            },
            permisos:{
                required:"Debe ingresar que tipo de usuario sera",
            },
           
        },
        submitHandler:function(form){
            agregar_usuario();
        }
    });
    generar();
});
function agregar_usuario(){
    var process = $("#process").val();

    if(process == "insertusuario"){
        var url  = "usuarios.php";
    }

    var form = $("#form9");
    var formdata = false;
    if(window.FormData)
    {
    	formdata = new FormData(form[0]);
    }
    var formAction = form.attr('action');
    $.ajax({
        type        : 'POST',
        url         : url,
        cache       : false,
        data        : formdata ? formdata : form.serialize(),
        contentType : false,
        processData : false,
        dataType : 'json',
        
        success:function(datax){
            if(datax.typeinfo == "success" || datax.typeinfo == "Succes"){
                setInterval("recarga();",1000);
            }
            Swal.fire({
                icon: datax.typeinfo,
                title: 'Tu resultado',
                text: datax.msg,
              })
        }
    });
}
function recarga(){
    location.reload();
}
function generar(){
    dataTable = $('#tabla3').DataTable({
		"pageLength": 5,
		"order":[[ 1, 'asc' ]],
		"processing": true,
		"serverSide": true,
		"ajax":{
		url :"tabla_usuarios.php",
		error: function()
		{  // error handling
			$(".tabla3-error").html("");
			$("#tabla3").append('<tbody class="tabla3_grid-error"><tr><th colspan="4">No se encontró información segun busqueda </th></tr></tbody>');
			$("#tabla3_processing").css("display","none");
			$( ".tabla3-error" ).remove();
			}
		},
		"columnDefs": [ {
		"targets": 1,//index of column starting from 0
		"render": function ( data, type, full, meta ) {
		if(data!=null)
		return '<p class="text-success"><strong>'+data+'</strong></p>';
		else
		return '';
		}
		}],
		"language":{
			"url": "js/Spanish.json"
		}
	});
	dataTable.ajax.reload();
};
function deleted(id){
    Swal.fire({
        title: "Eliminando los datos del usuario",
        text: "Espera un momento",
        type: "info",
        showLoaderOnConfirm: true,
        onOpen: function(){
            Swal.clickConfirm();
        },
        preConfirm:function(){
            return new Promise(function(resolve){
                $.ajax({
                    type : "POST",
                    url : "usuarios.php",
                    data: "process=elim_usuario&id_usuario="+id,
                    dataType: "JSON",
                    success : function(datax)
                    {
                        if(datax.typeinfo == "success" || datax.typeinfo == "Success"){
                            setInterval("recarga();",2000);
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
        }
    });
}
$(document).on("click",".elim",function()
{
    deleted($(this).attr("id_usuario"));
});