<?php
	require('conexion.php');

	$nombreCriterio = $_GET['nombre'];
	$descripcionCriterio = $_GET['descripcion'];
	$criterio = $_GET['id']; 

	//escape de las entradas del usuario para prevenir SQL Injection
	$nombreCriterio = $mysqli->real_escape_string($nombreCriterio);
	$descripcionCriterio = $mysqli->real_escape_string($descripcionCriterio);

	$query = "UPDATE criterios SET titular_es='$nombreCriterio', descripcion_es='$descripcionCriterio' WHERE id=$criterio";
	$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	
	$query1 = "SELECT * FROM criterios WHERE id = $criterio";

	//ejecutamos la consulta
	$query_result = $mysqli->query($query1) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	//por como tenemos la tabla solo deberiamos tener un resultado
	while($registro = $query_result->fetch_assoc()){
			$display_string .= "<br>
							<div class='col-xs-12 col-md-12 well'>
								<h2 class='titulo-items centrarTexto'> Criterio #".$registro['id']."</h2>
								<h3 class='titulo-criterio centrarTexto underline'>
									<b>".$registro['titular_es']."</b>
								</h3>
								<div class='justificar'>
									<span>".$registro['descripcion_es']."</span>
                					<span class='glyphicon glyphicon-pencil editar ec_css' data-toggle='modal' data-target='#modalEditarInfoCriterio'></span>
								</div>
							</div>";
	};
	
	echo $display_string;
	$query_result->free();
	$mysqli->close();

?>