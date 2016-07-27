<?php
	require('conexion.php');

	$id_criterio = $_GET['id_criterio'];

	$query = "SELECT * FROM criterios WHERE id = $id_criterio";

	//ejecutamos la consulta
	$query_result = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	//por como tenemos la tabla solo deberiamos tener un resultado
	while($registro = $query_result->fetch_assoc()){
			$display_string .= "<div class='modal-header'>
		          					<button type='button' class='close cancelarAnnadirCriterio' data-dismiss='modal'>&times;</button>
		          					<h4 class='modal-title'>Editando la información del Criterio</h4>
		        				</div>
		        				<div class='modal-body' id='camposAltaCriterio'>
		        					<div class='form-group' id='campoObligatorioNombreCriterio'>
					    				<label for='nombre'>Nombre*</label>
					    				<input type='text' class='form-control' id='nombreCriterio' value='".$registro['titular_es']."'>
									</div>

									<div class='form-group' id='campoObligatorioDescripcionCriterio'>
										<label for='descripcion'>Descripción*</label>
										<textarea class='form-control' rows='4' id='descripcionCriterio'>".$registro['descripcion_es']."</textarea>
									</div>
		        				</div>
			        				<div class='modal-footer'>
			            			<button type='button' class='btn btn-default cancelarAnnadirOAs' data-dismiss='modal'>Cancelar</button>
			        				<button type='button' class='btn btn-success' id='actualizarCriterio' onclick = 'actualizarCriterio(".$id_criterio.");'>Actualizar</button>
		        				</div>";
	};
	
	echo $display_string;
	$query_result->free();
	$mysqli->close();
	
?>