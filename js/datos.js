$(document).ready(function() {
    $("#plusap").css('display', 'none');
    $("#plusip").css('display', 'none');
    $("#editartorre").css('display', 'none');    
    $('#form2').validate({
        rules:{
            nombreap:{
                required:true,
            },
        },
        messages:{
            nombreap:{
                required:"Es necesario que ingrese el nombre de la ap",
            },
        },
        submitHandler:function(form){
            agregar_ap();
        }
    });

    $('#form3').validate({
        rules:{
            segmento:{
                required:true,
                ipv4:true,
            },
            cantidad:{
                required:true,
            },
        },
        messages:{
            segmento:{
                required:"Es necesario que nos indique el segmento de las ip",
                ipv4: "Esta no es una ip",
            },
            cantidad:{
                required:"Es necesario que nos indique la cantidad de ip's",
            },
        },
        submitHandler:function(form){
            var valor = $("#segmento").val();
            var cantidad = $("#cantidad").val();
            var ip = ip2long(valor);
            var ips = new Array();
            for (index = 0; index < cantidad; index++) {
                ips[index] = long2ip(ip);  
                ip = ip + 1;
                
            }
            Swal.fire({
                title: 'Ip´s para asignar a la torre?',
                text: ips,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                ConfirmButtonText: 'Si, continuar!'
            }).then((result) =>{
                if(result.value){
                   agregar_ip();
                }
            });
        }
    });
    $('#form4').validate({
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
            editar_torre();
        }
    });
    generar();
});
$("#plus").click(function(){
    $("#plusap").toggle();
    $("#plusip").hide();
    $("#editartorre").hide();
});
$("#plus2").click(function(){
    $("#plusip").toggle();
    $("#plusap").hide();
    $("#editartorre").hide();
});
$("#editar").click(function(){
    $("#editartorre").toggle();
    $("#plusap").hide();
    $("#plusip").hide();
});
$("#reporte").click(function(){
    window.open("reportextorre.php", '_blank');
      return false;
    
});
function agregar_ap(){

    var process = $("#process").val();

    if(process == "insertap"){
        var url  = "datos.php";
    }

    var form = $("#form2");
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
            if(datax.typeinfo == "success" || datax.typeinfo == "Success"){
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

function agregar_ip(){
    var process = $("#process").val();

    if(process == "insertsegmento"){
        var url  = "datos.php";
    }

    var form = $("#form3");
    var formdata = false;
    if(window.FormData)
    {
    	formdata = new FormData(form[0]);
    }
    var formAction = form.attr('action');
    Swal.fire({
        title: "Ingresando ip´s",
        text: "Espera un momento",
        type: "info",
        showLoaderOnConfirm: true,
        onOpen: function(){
            Swal.clickConfirm();
        },
        preConfirm:function(){
            return new Promise(function(resolve){
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    cache       : false,
                    data        : formdata ? formdata : form.serialize(),
                    contentType : false,
                    processData : false,
                    dataType : 'json',
                    
                    success:function(datax){

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
        },allowOutsideClick: false
    });
}

function recarga(){
    location.reload();
}

function ip2long(IP) {
    var i = 0;
    IP = IP.match( /^([1-9]\d*|0[0-7]*|0x[\da-f]+)(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?$/i );
    if (!IP) { return false; }
    IP[0] = 0;
    for (i = 1; i < 5; i += 1) {
      IP[0] += !!((IP[i] || '').length);
      IP[i] = parseInt(IP[i]) || 0;
    }
    IP.push(256, 256, 256, 256);
    IP[4 + IP[0]] *= Math.pow(256, 4 - IP[0]);
    if (IP[1] >= IP[5] || IP[2] >= IP[6] || IP[3] >= IP[7] || IP[4] >= IP[8]) { return false; }
    return IP[1] * (IP[0] === 1 || 16777216) + IP[2] * (IP[0] <= 2 || 65536) + IP[3] * (IP[0] <= 3 || 256) + IP[4] * 1;
  }

  function long2ip ( proper_address ) {  
    // Converts an (IPv4) Internet network address into a string in Internet standard dotted format    
    //   
    // version: 812.316  
    // discuss at: http://phpjs.org/functions/long2ip  
    // +   original by: Waldo Malqui Silva  
    // *     example 1: long2ip( 3221234342 );  
    // *     returns 1: '192.0.34.166'  
      
    var output = false;  
      
    if ( !isNaN ( proper_address ) && ( proper_address >= 0 || proper_address <= 4294967295 ) ) {  
        output = Math.floor (proper_address / Math.pow ( 256, 3 ) ) + '.' +  
            Math.floor ( ( proper_address % Math.pow ( 256, 3 ) ) / Math.pow ( 256, 2 ) ) + '.' +  
            Math.floor ( ( ( proper_address % Math.pow ( 256, 3 ) )  % Math.pow ( 256, 2 ) ) / Math.pow ( 256, 1 ) ) + '.' +  
            Math.floor ( ( ( ( proper_address % Math.pow ( 256, 3 ) ) % Math.pow ( 256, 2 ) ) % Math.pow ( 256, 1 ) ) / Math.pow ( 256, 0 ) );  
    }  
      
    return output;  
} 

function generar(){
	dataTable = $('#tabla1').DataTable({
		"pageLength": 50,
		"order":[[ 0, 'asc' ]],
		"processing": true,
		"serverSide": true,
		"ajax":{
		url :"tabla_ips.php",
		error: function()
		{  // error handling
			$(".tabla1-error").html("");
			$("#tabla1").append('<tbody class="tabla1_grid-error"><tr><th colspan="6">No se encontró información segun busqueda </th></tr></tbody>');
			$("#tabla1_processing").css("display","none");
			$( ".tabla1-error" ).remove();
			}
		},
		"columnDefs": [ {
		"targets": 3,//index of column starting from 0
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
	dataTable.ajax.reload()
}
function  editar_torre(){
    var process = $("#process").val();

    if(process == "edit"){
        var url  = "datos.php";
    }

    var form = $("#form4");
    var formdata = false;
    if(window.FormData)
    {
    	formdata = new FormData(form[0]);
    }
    var formAction = form.attr('action');
    Swal.fire({
        title: "Modificando informacion de la torre",
        text: "Espera un momento",
        type: "info",
        showLoaderOnConfirm: true,
        onOpen: function(){
            Swal.clickConfirm();
        },
        preConfirm:function(){
            return new Promise(function(resolve){
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    cache       : false,
                    data        : formdata ? formdata : form.serialize(),
                    contentType : false,
                    processData : false,
                    dataType : 'json',
                    
                    success:function(datax){

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
        },allowOutsideClick: false
    });
}
function liberar(id){
    Swal.fire({
        title: "Liberando la ip",
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
                    url : "datos.php",
                    data: "process=lib_ip&id_ip="+id,
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
$(document).on("click",".lib",function()
{
    liberar($(this).attr("id_ip"));
});
function noasignar(id){
    Swal.fire({
        title: "Marcando la ip para que no se asigne",
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
                    url : "datos.php",
                    data: "process=no_ip&id_ip="+id,
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
$(document).on("click",".no",function()
{
    noasignar($(this).attr("id_ip"));
});

function deleted(id){
    Swal.fire({
        title: "Eliminando la ip",
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
                    url : "datos.php",
                    data: "process=elim_ip&id_ip="+id,
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
    deleted($(this).attr("id_ip"));
});