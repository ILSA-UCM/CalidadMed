<?php
	require('conexion.php');
	//require('../js/nuestras_funciones.js');

	$nombreCriterio = $_GET['nombre'];
	$descripcionCriterio = $_GET['descripcion'];

	//escape de las entradas del usuario para prevenir SQL Injection
	$nombreCriterio = $mysqli->real_escape_string($nombreCriterio);
	$descripcionCriterio = $mysqli->real_escape_string($descripcionCriterio);

	$query = "INSERT INTO criterios (titular_es, descripcion_es) VALUES ('$nombreCriterio', '$descripcionCriterio')";
	$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$id = $mysqli->insert_id;

	//para asignarle el orden en el que tiene que mostrarse el criterio
	$query1 = "SELECT MAX(orden) AS orden FROM criterios";
	$query_result = $mysqli->query($query1) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$num_filas = $query_result->num_rows;
	$orden = 1; // el primero de la lista
	if($num_filas == 1){ //si ya hay más valores aqui se toma el orden que corresponda
		$fila = $query_result->fetch_assoc();
		$orden = $fila['orden'] + 1;
	}
	$query2 = "UPDATE criterios SET orden=$orden WHERE id=$id";
	$mysqli->query($query2) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	//contruimos los resultados
	$display_string = "<tbody>";
		$display_string .= "<tr>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= $nombreCriterio;
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= $descripcionCriterio;
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<div class='btn-group'>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg editarCriterio' data-id=$id onclick = " ."parent.location='items.php?id=$id' data-toggle='Editar' title='Editar criterio'>";
						$display_string .= "<span class='glyphicon glyphicon-pencil editar'></span>";
					$display_string .= "</button>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg ecriterio' id=$id data-toggle='Eliminar' title='Eliminar criterio'>";
				    	$display_string .= "<span class='glyphicon glyphicon-trash icon-remove eliminar'></span>";
					$display_string .= "</button>";
				$display_string .= "</div>";
			$display_string .= "</td>";
		$display_string .= "</tr>";
	$display_string .= "</tbody>";

	echo $display_string;

	$mysqli->close();

?>