<?php
session_start();
include_once "_conexion.php";
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CableSat</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
   <!--JQUERY-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

   
    <link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css">
    
</head>
<body>
<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/logo.png">
		</div>
		<div class="login-content">
        <form method="post" role="form" id="form_login">
				<img src="img/avatar.svg">
				<h2 class="title">Bienvenido</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="username" id="" autocomplete="off">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password" id="password" autocomplete="off">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="plugins/sweetalert/sweetalert2.min.js"></script>   
</body>
</html>
<?php
include_once "_conexion.php";
if ($_POST) {
	$user = $_POST["username"];
	$clave = md5($_POST["password"]);
	$consulta = _query("SELECT * FROM usuarios WHERE usuario='$user'");
	$numero = _num_rows($consulta);
	if ($numero > 0) {
		$datos = _fetch_array($consulta);
		if ($datos["clave"] == $clave) {
			$_SESSION["id_usuario"] = $datos["id_usuario"];
			$_SESSION["user"] = $user;
			$_SESSION["admin"] = $datos["id_tipo"];
			$_SESSION["name"] = $datos["usuario"];
			if($datos['id_tipo'] == 3){
				echo "<script>location.replace('itecnico.php');</script>";
			}else{
			echo "<script>location.replace('dashboard.php');</script>";
			}
		} else {
			echo "<script>swal.fire('Info','La clave es incorrecta','warning');</script>";
		}
	} else {
		echo "<script>swal.fire('Info','El usuario ingresador no existe','error');</script>";
	}
}
?>