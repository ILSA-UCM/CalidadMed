<?php
	require('conexion.php');

	$id = $_GET['id'];

	$query = "SELECT * FROM items";
	$query_items_num = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$num_items = $query_items_num->num_rows;
	//echo "Num items ="+$num_items;

	//$query1 = "SELECT itemsevaluados FROM resultados WHERE id_oa=$oas";
	$query1 = "SELECT * FROM resultados WHERE id_oa=".$id;
	$query_evaluados = $mysqli->query($query1) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$num_filas = $query_evaluados->num_rows;
	//echo "NUm filas de la tabla resultados="+$num_filas;

	$num_items_evaluados=0;
	
	if($num_filas==1){
		$fila = $query_evaluados->fetch_assoc();
		$num_items_evaluados = $fila['itemsevaluados'];
	}

	$porcentaje = ($num_items_evaluados/$num_items)*100;
	$porcentaje = round($porcentaje, 0, PHP_ROUND_HALF_UP);

	$display_string = "";
	$display_string .= "<div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:". $porcentaje ."%' >" .$porcentaje ."% </div>";
	echo $display_string;
	$mysqli->close();

?>