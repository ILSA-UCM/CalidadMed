<?php
	require('conexion.php');

	$id_oa = $_GET['id_oa'];

	$query = "DELETE FROM oas WHERE id = $id_oa";

	//ejecutamos la consulta
	$query_result = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	
	$query_oas = "SELECT * FROM oas";

	$query_oas = $mysqli->query($query_oas) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	$display_string .= "<thead>
				  	<tr>
						<th width='8%''>Id</th>
						<th>Nombre</th>
						<th width='10%''>Estado</th>
						<th width='18%'>Opciones</th>
				  	</tr>
				</thead>";

	while($registro = $query_oas->fetch_assoc()){
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
					$display_string .= $registro['titular'];
					$display_string .= "</span>";
				$display_string .= "</td>";
				$display_string .= "<td>";
					$display_string .= "<span>";
					$display_string .= $registro['estado'];
					$display_string .= "</span>";
				$display_string .= "</td>";
				$display_string .= "<td>";
					$display_string .= "<div class='btn-group'>";
						$display_string .= "<button type='button' class='btn btn-default btn-lg' ";
						if(($registro['estado'] == 'Evaluado') || ($registro['estado'] == 'Cancelado*')){
							$display_string .= "disabled";
						}
						$display_string .= " onclick="."parent.location='evaluacion.php?id=".$registro['id']."&estado=Borrador' >";
							$display_string .= "<span class='glyphicon glyphicon-play evaluar'></span>";
						$display_string .= "</button>";

						$display_string .= "<button type='button' class='btn btn-default btn-lg'";
						if($registro['estado'] == 'Borrador'){
							$display_string .= "disabled";
						}
						
						$display_string .= " onclick="."parent.location='descarga_final.php?id=".$registro['id']."' >";
							$display_string .= "<span class='glyphicon glyphicon-download-alt descargar'></span>";
						$display_string .= "</button>";
						
						$display_string .= "<button type='button' class='btn btn-default btn-lg eoa' id=";
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