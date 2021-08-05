$(document).ready(function(){
  $("#tecnicoasigna").css("display", "none");
    $("#torre").on("change", function () {
      datotorre = this.value;  
        Swal.fire({
            title: 'Esta seguro?',
            text: "Ha escogido bien la torre de la que desea la ip!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, escogi bien!'
          }).then((result) => {
            if (result.value) {
              $("#tecnicoasigna").css("display","block");
              $.ajax({
                type        : 'POST',
                url         : "intermediario.php",
                data        : {id:datotorre},
                dataType : 'json',
                
                success:function(datax){
                  $('.ap').html(datax).fadeIn();
                }
            });
                       
            }
          })
    });
});