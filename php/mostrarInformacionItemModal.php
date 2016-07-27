<?php
	require('conexion.php');

	$id_item = $_GET['id_item'];

	$query = "SELECT * FROM items WHERE id = $id_item";

	//ejecutamos la consulta
	$query_result = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$display_string = "";

	//por como tenemos la tabla solo deberiamos tener un resultado
	while($registro = $query_result->fetch_assoc()){
			$display_string .= "<div class='modal-header'>
		          					<button type='button' class='close cancelarAnnadirItems' data-dismiss='modal'>&times;</button>
		          					<h4 class='modal-title'>Editando la información del Item</h4>
		        				</div>
		        				<div class='modal-body' id='camposAltaItems'>
		        					<div class='form-group campoObligatorioNombreItems'>
					    				<label for='nombre'>Nombre*</label>
					    				<input type='text' class='form-control' id='nombreItemsE' value='".$registro['item_es']."'>
									</div>

									<div class='form-group campoObligatorioDescripcionItems'>
										<label for='descripcion'>Descripción*</label>
										<textarea class='form-control' rows='4' id='descripcionItemsE'>".$registro['descripcion_es']."</textarea>
									</div>

									<form class='form-horizontal' role='form'>
										<div class='form-group'>
											<label for='nivel del item' class='col-lg-1 control-label'>Nivel</label>
				    						<div class='col-lg-2'>
												<select name='nivelItemsE' class='nivelItemsE form-control'>
													<option value='M'"; if($registro['nivel'] == 'M') {
														$display_string .= " selected"; } 
														$display_string .= ">M</option>
													<option value='E'"; if($registro['nivel'] == 'E') {
														$display_string .= " selected";
													} $display_string .= ">E</option>
												</select>
											</div>
										</div>
									</form>

		        				</div>
			        				<div class='modal-footer'>
			            			<button type='button' class='btn btn-default cancelarAnnadirItems' data-dismiss='modal'>Cancelar</button>
			        				<button type='button' class='btn btn-success' id='actualizarItem' onclick = 'actualizarItem(".$id_item.");'>Actualizar</button>
		        				</div>";
	};
	
	echo $display_string;
	$query_result->free();
	$mysqli->close();
	
?>