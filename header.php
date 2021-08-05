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
	</style>
</head>

<body class="page-body  page-fade" data-url="http://neon.dev">
	<div class="page-container">
		<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		<div class="sidebar-menu">
			<div class="sidebar-menu-inner">
				<header class="logo-env">
					<!-- logo -->
					<div class="logo">
						<a href="index.php" class="logo">
							<img src="img/logo.png" alt="logo" width="120" height="100">
						</a>
					</div>

					<!-- logo collapse icon -->
					<div class="sidebar-collapse">
						<a href="#" class="sidebar-collapse-icon">
							<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
							<i class="entypo-menu"></i>
						</a>
					</div>


					<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
					<div class="sidebar-mobile-menu visible-xs">
						<a href="#" class="with-animation">
							<!-- add class "with-animation" to support animation -->
							<i class="entypo-menu"></i>
						</a>
					</div>

				</header>

				<?php
				include("menu.php");
				?>


			</div>

		</div>

		<div class="main-content">

			<div class="row">

				<!-- Profile Info and Notifications -->
				<div class="col-md-6 col-sm-8 clearfix">

					<ul class="user-info pull-left pull-none-xsm">

						<!-- Profile Info -->
						<li class="profile-info dropdown">
							<!-- add class "pull-right" if you want to place this from right -->
							<h2 class="usuario"><?php echo $_SESSION["name"] ?></h2>
						</li>

					</ul>

				</div>


				<!-- Raw Links -->
				<div class="col-md-6 col-sm-4 clearfix hidden-xs">

					<ul class="list-inline links-list pull-right">
						<?php
						if ($_SESSION["admin"] == 4 || $_SESSION["admin"] == 1) {
						?>
							<li class="dropdown">
								<a href="ajuste.php">
									<i class="entypo-cog"></i>
									Ajuste
								</a>
							</li>
						<?php
						}
						?>
						<li class="sep"></li>
						<li>
							<a href="logout.php">
								Cerrar sesion <i class="entypo-logout right"></i>
							</a>
						</li>
					</ul>

				</div>

			</div>

			<hr />