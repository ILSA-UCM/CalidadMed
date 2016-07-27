<?php
	require('conexion.php');
	include('guardar_xml.php');
	
	$id_criterio = $_GET['id_criterio'];
	$id_item = $_GET['id_item'];

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

	//ahora si puedo borrar el items
	$query = "DELETE FROM items WHERE id = $id_item and id_criterio = $id_criterio";

	//ejecutamos la consulta
	$query_result = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	
	$query_items= "SELECT * FROM items where id_criterio=$id_criterio ORDER BY orden";

	$query_items_resul= $mysqli->query($query_items) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	$display_string .= "<thead>
				  	<tr>
						<th width='25%'>Nombre</th>
						<th>Descripción</th>
						<th width='15%'>Opciones</th>
				  	</tr>
				</thead>";

	while($registro = $query_items_resul->fetch_assoc()){
		//contruimos los resultados
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
						$display_string .= "<button type='button' class='btn btn-default btn-lg editarItem' data-id=";
						$display_string .= $registro['id'] ." >";
							$display_string .= "<span class='glyphicon glyphicon-pencil editar'></span>";
						$display_string .= "</button>";
						$display_string .= "<button type='button' class='btn btn-default btn-lg eliminarItems' id=";
						$display_string .= $registro['id'] .">";
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