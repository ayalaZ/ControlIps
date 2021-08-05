<?php
include('_core.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <title>CableSat</title>
    <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">

    <link rel="stylesheet" href="assets/css/neon-core.css">
    <link rel="stylesheet" href="assets/css/neon-theme.css">

    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css">

    <script src="assets/js/jquery-1.11.3.min.js"></script>

    <!-- Data Tables -->
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/neon-forms.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <style media="screen">
        h1 {
            color: #fff !important;
            font-weight: bold;
            margin: 0px;
        }

        .usuario {
            font-weight: bold;
            font-size: 200%;
            text-transform: uppercase;
        }

        .page-header {
            padding: 0px;
            margin: 0px;
        }

        .jumbotron {
            position: relative;
            background-size: cover;
            background-color: #343a40;
            height: 100%;
            text-align: center;
            color: #fff;
        }

        .mensaje {
            font-family: "Brush Script MT", cursive;
            font-size: 40px !important;
            font-style: italic;
        }
    </style>
</head>
<div class="page-header">
    <div class="jumbotron">
        <div>
            <a href="index.php">
                <img src="img/logo.png" alt="logo" width="240" height="200">
            </a>
        </div>
        <p class="mensaje">Conecta tu vida!</p>
    </div>
</div>

<body class="page-body  page-fade" data-url="http://neon.dev">
    <div class="page-container">
        <div class="main-content">

            <div class="row">

                <!-- Profile Info and Notifications -->
                <div class="col-md-6 col-sm-8 clearfix">

                    <ul class="user-info pull-left pull-none-xsm">

                        <!-- Profile Info -->
                        <li class="profile-info dropdown">
                            <!-- add class "pull-right" if you want to place this from right -->
                            <h2 class="usuario" onclick="$(location).attr('href','logout.php');" style="cursor:pointer;"><?php echo $_SESSION["name"] ?></h2>
                        </li>

                    </ul>

                </div>


                <!-- Raw Links -->
                <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                    <ul class="list-inline links-list pull-right">
                        <li>
                            <a href="logout.php">
                                Cerrar sesion <i class="entypo-logout right"></i>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background-color: #343a40;">
                            <div class="panel-title">Selecciona la torre de la que desea su ip </div>
                        </div>
                        <div class="panel-body">
                            <select id="torre" name="torre" class="selectpicker form-control form-control-lg">
                            <option value="">Seleccione la torre de la cual desea la ip</option>
                                <?php
                                $torres = "SELECT * FROM torres";
                                $resultados = _query($torres);
                                $items = _num_rows($resultados);
                                for ($i = 0; $i < $items; $i++) {
                                    $row = _fetch_array($resultados);
                                    $id = $row['id_torre'];
                                    $menu = $row['nombre_torre'];
                                ?>
                                    <option value="<?php echo $id ?>"><?php echo $menu ?></option>
                                <?php
                                $_SESSION["torre"] = $id;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-primary" id="tecnicoasigna" name="tecnicoasigna">
                        <div class="panel-heading" style="background-color:#343a40;">
                            <div class="panel-title">Ingrese los datos para obetener su ip</div>
                        </div>
                        <div class="panel-body">
                            <form method="POST" role="form" id="form5">
                                <div class="form-group col-sm-12">
                                    <label for="codigo_cliente" class="control-label">Codigo del cliente</label>
                                    <input type="number" class="form-control" id="codigo_cliente" name="codigo_cliente" placeholder="#####" autocomplete="off">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="nombre_cliente" class="control-label">Nombre completo del cliente</label>
                                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre del cliente" style="text-transform:uppercase;" autocomplete="off">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="ap" class="control-label">Ap a asignar</label>
                                    <select name="ap" id="ap" class="form-control ap">
                                        <option value="">Seleccione la ap a la que conectara al cliente</option>
                                       
                                    </select>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div>
                                                <input type="hidden" name="process" id="process" value="asignar">
                                               
                                                <button type="submit" class="btn btn-lg btn-danger">Obtener Ip</button>
                                                <button type="reset" class="btn btn-lg btn-danger">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
include('footer.php');
echo "<script src='js/funciones_tecnicos.js'></script>";
?>