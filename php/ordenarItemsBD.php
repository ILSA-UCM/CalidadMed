<?php
	require('conexion.php');

	$data = json_decode($_POST['jObject'], true);
	$orden = 1; //el orden empieza en 1
	foreach ($data as $value) {
	 	$query = "UPDATE items SET orden = $orden WHERE id=$value";
		$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
		$orden++;
		echo $value; //se puede ocultar esta linea ...
	}
?>