<?php
 	session_start();
 	if(!isset($_SESSION["user"]))
 	{
 		echo "<script>location.replace('index.php');</script>";
 	}else{
		 if($_SESSION["admin"] == '3' && $_SERVER['REQUEST_URI'] != '/ControlIpTorres/itecnico.php'){
			echo "<script>location.replace('itecnico.php');</script>";
		 }
	 }
 ?>
