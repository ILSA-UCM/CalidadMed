<?php
	require('conexion.php');

	$nombreItem = $_GET['nombre'];
	$descripcionItem = $_GET['descripcion'];
	$item = $_GET['id_item']; 
	$criterio = $_GET['id_criterio'];
	$nivel = $_GET['nivel'];

	//escape de las entradas del usuario para prevenir SQL Injection
	$nombreCriterio = $mysqli->real_escape_string($nombreItem);
	$descripcionCriterio = $mysqli->real_escape_string($descripcionItem);

	$query = "UPDATE items SET item_es='$nombreItem', descripcion_es='$descripcionItem', nivel='$nivel' WHERE id=$item AND id_criterio=$criterio";

	$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	
	$query1 = "SELECT * FROM items WHERE id_criterio=$criterio";

	//ejecutamos la consulta
	$query_result = $mysqli->query($query1) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	$display_string .= "
		<thead>
		  	<tr>
				<th width='25%'>Nombre</th>
				<th>Descripción</th>
				<th width='15%'>Opciones</th>
		  	</tr>
		</thead>";

	//por como tenemos la tabla solo deberiamos tener un resultado
	while($registro = $query_result->fetch_assoc()){
		$display_string .= "<tbody>";
		$display_string .= "<tr>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= $registro['item_es'];
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= $registro['descripcion_es'];
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<div class='btn-group'>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg editarItem' data-id=".$registro['id'].">";
						$display_string .= "<span class='glyphicon glyphicon-pencil editar'></span>";
					$display_string .= "</button>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg eliminarItems' id=$item >";
				    	$display_string .= "<span class='glyphicon glyphicon-trash icon-remove eliminar'></span>";
					$display_string .= "</button>";
				$display_string .= "</div>";
			$display_string .= "</td>";
		$display_string .= "</tr>";
		$display_string .= "</tbody>";
	};
	
	echo $display_string;
	$query_result->free();
	$mysqli->close();

?>