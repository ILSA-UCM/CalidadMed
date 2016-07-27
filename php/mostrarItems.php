<?php
	require('conexion.php');

	$id_criterio = $_GET['id_criterio'];

	$query = "SELECT * FROM items WHERE id_criterio = $id_criterio";

	//ejecutamos la consulta
	$query_result = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	$display_string .= "<thead>
				  	<tr>
						<th width='8%'>Id</th>
						<th width='25%'>Nombre</th>
						<th>Descripción</th>
						<th width='15%'>Opciones</th>
				  	</tr>
				</thead>";

	while($registro = $query_criterios_resul->fetch_assoc()){
		//contruimos los resultados
		$display_string .= "<tbody>";
			$display_string .= "<tr>";
				$display_string .= "<td>";
					$display_string .= "<span>";
					$display_string .= $registro['id'];
					$display_string .= "</span>";
				$display_string .= "</td>";
				$display_string .= "<td>";
					$display_string .= "<span>";
					$display_string .= $registro['titular_es'];
					$display_string .= "</span>";
				$display_string .= "</td>";
				$display_string .= "<td>";
					$display_string .= "<span>";
					$display_string .= $registro['descripcion_es'];
					$display_string .= "</span>";
				$display_string .= "</td>";
				$display_string .= "<td>";
					$display_string .= "<div class='btn-group'>";
						$display_string .= "<button type='button' class='btn btn-default btn-lg editarCriterio'>";
							$display_string .= "<span class='glyphicon glyphicon-pencil editar'></span>";
						$display_string .= "</button>";
						$display_string .= "<button type='button' class='btn btn-default btn-lg ecriterio' id=";
						$display_string .= $registro['id'];
						$display_string .= "> ";
					    	$display_string .= "<span class='glyphicon glyphicon-trash icon-remove eliminar'></span>";
						$display_string .= "</button>";
					$display_string .= "</div>";
				$display_string .= "</td>";
			$display_string .= "</tr>";
		$display_string .= "</tbody>";
	}

	$display_string .="</table>";

	echo $display_string;
	$mysqli->close();
?>