$(document).ready(function() {
    $('#form1').validate({
        rules:{
            torre:{
                required: true,
            },
            coordenadas:{
                required: true,
            },
            aps:{
                required:true,
            },
            cuenta:{
                required:true,
            }
        },
        messages:{
            torre:{
                required: "Porfavor ingrese el nombre de la torre",
            },
            coordenadas:{
                required: "Porfavor ingrese las coordenadas de la torre",
            },
            aps:{
                required: "Introduzca la cantida de aps que tiene la torre",    
            },
            cuenta:{
                required: "Instroduzca la cuenta a la que pertenece la torre",
            },
        },
        submitHandler:function(form){
            agregar_torre();
        }
    });
    generar();
});
function agregar_torre(){
   
    var process = $("#process").val();

    if(process == "insert"){
        var url  = "torres.php";
    }

    var form = $("#form1");
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
           // display_notify(datax.typeinfo, datax.msg);
        }
    });
}
function recarga(){
    location.replace("torres.php");
}
function generar(){
    dataTable = $('#tabla2').DataTable({
		"pageLength": 50,
		"order":[[ 0, 'asc' ]],
		"processing": true,
		"serverSide": true,
		"ajax":{
		url :"tabla_torre.php",
		error: function()
		{  // error handling
			$(".tabla2-error").html("");
			$("#tabla2").append('<tbody class="tabla2_grid-error"><tr><th colspan="6">No se encontró información segun busqueda </th></tr></tbody>');
			$("#tabla2_processing").css("display","none");
			$( ".tabla2-error" ).remove();
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
}
function deleted(id){
    Swal.fire({
        title: "Eliminando los datos de la torre",
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
                    url : "torres.php",
                    data: "process=elim_torre&id_torre="+id,
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
    deleted($(this).attr("id_torre"));
});