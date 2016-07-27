<?php
	require('cabecera.php');
	require ('php/conexion.php');
?>

<!--Esto solo es para cambiar el active del navbar-->
<script type="text/javascript">
	$(".navbar-nav li").each(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        }
    });
	$("#configuracion").addClass("active");
</script>


<div class="container">
	<br>
	<div class="row">
		<div class="col-xs-12 col-md-12 centrarTexto">
			<h2>Criterios</h2>
		</div>
	</div>

	<div class="row">
		<div class="table-responsive"> <!-- Pensar si dejar este div o no.... -->
			<table class="table table-hover table-bordered" id="tabla-criterios">
				<thead>
				  	<tr>
						<th width="25%">Nombre</th>
						<th>Descripción</th>
						<th width="15%">Opciones</th>
				  	</tr>
				</thead>
				<?php
					$query_criterios = "SELECT * FROM criterios ORDER BY orden";
					//consulto la consulta
					$tabla_criterios = $mysqli->query($query_criterios) or die ($mysqli->error. " en la línea ".(__LINE__-1));
					while($registro = $tabla_criterios->fetch_assoc()){
				?>
				<tbody>
					<tr>
						<td>
							<span><?php echo $registro['titular_es']; ?></span>
						</td>
						<td>
							<span><?php echo $registro['descripcion_es']; ?></span>
						</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-lg editarCriterio" data-id="<?php echo $registro['id'];?>" onclick="parent.location='items.php?id=<?php echo $registro['id'];?>'" data-toggle="Editar" title="Editar criterio">
				                    <span class="glyphicon glyphicon-pencil editar"></span>
				            	</button>
				            	<button type="button" class="btn btn-default btn-lg ecriterio" id="<?php echo $registro['id']; ?>" data-toggle="Eliminar" title="Eliminar criterio">
				                    <span class="glyphicon glyphicon-trash icon-remove eliminar"></span>
				            	</button>
			            	</div>
						</td>
					</tr>
				</tbody>
				<?php 
					}
					$tabla_criterios->free();
				?>
			</table>
		</div>
	</div>

	<div class="row ordenarCI">
    	<button type="button" class="btn btn-default right" data-toggle="modal" data-target="#modalAnnadirCriterio">
            <span class="glyphicon glyphicon-plus-sign icon-add annadir"></span>
    	</button>

    	<button type="button" class="btn btn-primary btn-lg right" onclick="parent.location='ordenarCriterios.php'"> Ordernar Criterios e items </button>

    	<button type="button" class="btn btn-primary btn-lg right" data-toggle="modal" data-target="#modalRangoEvaluacion">Configurar rango de evaluación</button>
	</div>

    <br>

	<!--Para añadir un criterio a la tabla-->
    <div class="modal fade" id="modalAnnadirCriterio" role="dialog">
	    <div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close cancelarAnnadirOAs" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Añadir un Criterio</h4>
		        </div>
		        <div class="modal-body" id="camposAltaCriterio">
		        	<div class="form-group" id="campoObligatorioNombreCriterio">
					    <label for="nombre">Nombre*</label>
					    <input type="text" class="form-control" id="nombreCriterio">
					</div>

					<div class="form-group" id="campoObligatorioDescripcionCriterio">
						<label for="descripcion">Descripción*</label>
						<textarea class="form-control" rows="4" id="descripcionCriterio"></textarea>
					</div>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-default cancelarAnnadirCriterio" data-dismiss="modal">Cancelar</button>
		        	<button type="button" class="btn btn-success" id="annadirCriterio" onclick = 'annadirCriterio();'>Añadir</button>
		          <!--En este boton es donde se pondría para eliminar el criterio de la lista comunicacion con bd y actualizar la tabla-->
		        </div>
	      	</div>
	    </div>
	</div>

	<div class="modal fade" id="modalRangoEvaluacion" role="dialog">
	    <div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close cancelarAnnadirRangoEvaluacion" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Rango de puntuación de la Evaluación</h4>
		        </div>
		        <div class="modal-body">
		        	<form class="form-group" action="php/actualizarRango.php" method="post">
		        		<?php
		        			$query_rango = "SELECT * FROM rango";
							//consulto la consulta
							$tabla_rango = $mysqli->query($query_rango) or die ($mysqli->error. " en la línea ".(__LINE__-1));
							$fila = $tabla_rango->fetch_assoc();
							$minimo = $fila['minimo'];
							$maximo = $fila['maximo'];
							$id_rango = $fila['id'];
							$tabla_rango->free();
							$mysqli->close();
						?>

		        		<label for="nombre">Mínimo*</label>
						<input type="number" name="rangominimo" min="0" class="form-control rangominimo" value=<?php echo $minimo; ?> required>
						<br>
						<label for="nombre">Máximo*</label>
						<input type="number" name="rangomaximo" min="0" class="form-control rangomaximo" value=<?php echo $maximo; ?> required>
						<br>
						<input type="hidden" name="id" value=<?php echo $id_rango; ?> >
						<input type="submit" class="btn btn-success right" value="Actualizar">
						<br>
					</form>
		        </div>
	      	</div>
	    </div>
	</div>

</div>

<a href="#" class="scrollup" title="Back to top" > </a>

<?php
	require('pie.php');
?>