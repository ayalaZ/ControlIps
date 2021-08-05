$(document).ready(function() {
    
    generar();
});
function generar(){
    dataTable = $('#tabla3').DataTable({
		"pageLength": 5,
		"order":[[ 3, 'asc' ]],
		"processing": true,
		"serverSide": true,
		"ajax":{
		url :"tabla_ap.php",
		error: function()
		{  // error handling
			$(".tabla3-error").html("");
			$("#tabla3").append('<tbody class="tabla3_grid-error"><tr><th colspan="5">No se encontró información segun busqueda </th></tr></tbody>');
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
	dataTable.ajax.reload()
}
function deleted(id){
    Swal.fire({
        title: "Eliminando la ap",
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
                    url : "aps.php",
                    data: "process=elim_ap&id_ap="+id,
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
    deleted($(this).attr("id_ap"));
});
function recarga(){
    location.reload();
}