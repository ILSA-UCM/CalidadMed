<?php
//invisible para el usuario
$servername = "SERVER";
$username = "USER_SERVER";
$password = "PASSWORD";
$dbname = "DB_NAME";

	$mysqli = new mysqli($servername, $username, $password, $dbname); 
	if ( mysqli_connect_errno() ) { 
		echo "Error de conexion a la BD: ".mysqli_connect_error(); 
		exit(); 
	}
?>
