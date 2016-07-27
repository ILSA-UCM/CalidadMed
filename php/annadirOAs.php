<?php
	require('conexion.php');
	//require('../js/nuestras_funciones.js');

	$nombreOAs = $_GET['nombre'];
	$descripcionOAs = $_GET['descripcion'];


	//escape de las entradas del usuario para prevenir SQL Injection
	$nombreOAs = $mysqli->real_escape_string($nombreOAs);
	$descripcionOAs = $mysqli->real_escape_string($descripcionOAs);

	//quito valores html como por ejemplo script.... evitar ataques xss
	$nombreOAs=strip_tags($nombreOAs);

	echo $nombreOAs;

	$estado = "Borrador";
	//contruccion de la query
	$query = "INSERT INTO oas (titular,descripcion,estado) VALUES ('$nombreOAs', '$descripcionOAs','$estado')";

	//ejecutamos la consulta
	$query_result = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	//vamos a obtener el id dado, con varios usuarios tener cuidado con esto
	$id = $mysqli->insert_id;


	//vamos a crear la plantilla de la evaluación
	$criterios = $mysqli->query("SELECT * FROM criterios") or die ($mysqli->error. " en la línea ".(__LINE__-1));

	//para cada criterio
	while($criterio = $criterios->fetch_assoc()){
		//para cada item del criterio (todos los items del criterio)
		$items = $mysqli->query("SELECT * FROM items WHERE id_criterio =" .$criterio['id']);
		$id_crit = $criterio['id'];
		while ($item = $items->fetch_assoc()){
			//vamos a crear la tabla de evaluaciones con los valores por defecto
			$id_it = $item['id'];
			$mysqli->query("INSERT INTO evaluaciones (id_criterio, id_item, id_OA) VALUES ( $id_crit, $id_it, $id)");

		}
		$items->free();
	}
	$criterios->free();



	$display_string = "";

	//contruimos los resultados
	$display_string = "<tbody id='table_content'>";
		$display_string .= "<tr>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= $id;
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= $nombreOAs;
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= "Borrador";
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<div class='btn-group'>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg' onclick="."parent.location='evaluacion.php?id=$id&estado=Borrador' >";
						$display_string .= "<span class='glyphicon glyphicon-play evaluar'></span>";
					$display_string .= "</button>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg' disabled>";
						$display_string .= "<span class='glyphicon glyphicon-download-alt descargar'></span>";
					$display_string .= "</button>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg eoa' id=$id >";
				    	$display_string .= "<span class='glyphicon glyphicon-trash icon-remove eliminar'></span>";
					$display_string .= "</button>";
				$display_string .= "</div>";
			$display_string .= "</td>";
		$display_string .= "</tr>";
	$display_string .= "</tbody>";

	echo $display_string;

	//libero resultados
	//$mysqli->free();
	//cierro la conexion con la bd
	$mysqli->close();
?>
