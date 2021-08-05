$(document).ready(function () {
  $("#opcion2").css("display", "none");
  $("#opcion3").css("display", "none");
  $("#tipo").on("change", function () {
    if (this.value == 2) {
      $("#opcion2").css("display", "block");
    } else {
      if (this.value == 3) {
        $("#opcion2").css("display", "block");
      } else {
        if (this.value == 4) {
          $("#opcion3").css("display", "block");
          $("#opcion2").css("display", "none");
        } else {
          $("#opcion2").css("display", "none");
          $("#opcion3").css("display", "none");
        }
      }
    }
  });

});

$("#generar").click(function () {
  var url;
  var opcion1 = $("#tipo").val();
  var opcion2 = $("#torre").val();
  var opcion3 = $("#ap").val();
  if (opcion1 == 1) {
    url = "reporte_torres.php";
  } else {
    if (opcion1 == 2) {
      url = "reporte_ap.php?t=" + opcion2;
    } else {
      if (opcion1 == 3) {
        url = "reporte_ip.php?t=" + opcion2;
      } else {
        if (opcion1 == 4) {
          url = "reporte_asignaciones.php?a=" + opcion3;
        } else {
          url = "reporte_usuarios.php";
        }
      }
    }
  }
  Swal.fire({
    title: "Generando reportes",
    text: "Espera un momento",
    type: "info",
    showLoaderOnConfirm: true,
    onOpen: function () {
      Swal.clickConfirm();
    },
    preConfirm: function () {
      return new Promise(function (resolve) {
        window.open(url, "_blank");
        setInterval(location.reload(), 2000);
      });
    },
    allowOutsideClick: false,
  });
});
