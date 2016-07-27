<?php
	require('conexion.php');
	include('guardar_xml.php');
	
	$minimo = $_POST['rangominimo'];
	$maximo = $_POST['rangomaximo'];
	$id = $_POST['id'];

	//primero tengo que crear todos los documentos de los objetos que estan en estado de borrador (Estado=Cancelado)
	$objetosCambiarStado = "SELECT * FROM oas where estado='Borrador' ";
	$oBorrador = $mysqli->query($objetosCambiarStado) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	while($registro = $oBorrador->fetch_assoc()){
		//cambiar el estado del objeto.
		$id_o = $registro['id'];
		$queryEstado = "UPDATE oas SET estado='Cancelado*' WHERE id=$id_o";
		$mysqli->query($queryEstado) or die ($mysqli->error. " en la línea ".(__LINE__-1));

		//creo su xml con el proceso del objeto.
		guardar_xml($registro['id']);
	}

	$query = "UPDATE rango SET minimo=$minimo, maximo=$maximo WHERE id=$id";
	$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$mysqli->close();

	header('Location: ../criterios.php'); 

?>