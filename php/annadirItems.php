<?php
	require('conexion.php');
	include('guardar_xml.php');
	//require('../js/nuestras_funciones.js');

	$nombreItems = $_GET['nombre'];
	$descripcionItems = $_GET['descripcion'];
	$id_criterio = $_GET['id_criterio'];
	$nivel = $_GET['nivel'];

	//escape de las entradas del usuario para prevenir SQL Injection
	$nombreItems = $mysqli->real_escape_string($nombreItems);
	$descripcionItems = $mysqli->real_escape_string($descripcionItems);

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



	$query = "INSERT INTO items (item_es, descripcion_es,id_criterio, nivel) VALUES ('$nombreItems', '$descripcionItems',$id_criterio, '$nivel')";
	$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$id = $mysqli->insert_id;

	//para asignarle el orden en el que tiene que mostrarse el item
	$query1 = "SELECT MAX(orden) AS orden FROM items WHERE id_criterio=$id_criterio";
	$query_result = $mysqli->query($query1) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$num_filas = $query_result->num_rows;
	$orden = 1; // el primero de la lista
	if($num_filas == 1){ //si ya hay más valores aqui se toma el orden que corresponda
		$fila = $query_result->fetch_assoc();
		$orden = $fila['orden'] + 1;
	}
	$query2 = "UPDATE items SET orden=$orden WHERE id=$id";
	$mysqli->query($query2) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	//contruimos los resultados
	$display_string = "<tbody>";
		$display_string .= "<tr>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= $nombreItems;
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<span>";
				$display_string .= $descripcionItems;
				$display_string .= "</span>";
			$display_string .= "</td>";
			$display_string .= "<td>";
				$display_string .= "<div class='btn-group'>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg editarItem' data-id=$id >";
						$display_string .= "<span class='glyphicon glyphicon-pencil editar'></span>";
					$display_string .= "</button>";
					$display_string .= "<button type='button' class='btn btn-default btn-lg eliminarItems' id=$id >";
				    	$display_string .= "<span class='glyphicon glyphicon-trash icon-remove eliminar'></span>";
					$display_string .= "</button>";
				$display_string .= "</div>";
			$display_string .= "</td>";
		$display_string .= "</tr>";
	$display_string .= "</tbody>";

	echo $display_string;

	$mysqli->close();

?>