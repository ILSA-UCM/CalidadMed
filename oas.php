<?php
	require ('cabecera.php');
	require ('php/conexion.php');


?>
<!--Esto solo es para cambiar el active del navbar-->
<script type="text/javascript">
	$(".navbar-nav li").each(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        }
    });
	$("#oas").addClass("active");
</script>

<div class="container">
	<br>
	<div class="row">
		<div class="col-xs-12 col-md-12 centrarTexto">
			<h2>Sus Materiales</h2>
		</div>
	</div>

	<div class="row well">
		<div class="col-xs-2 col-md-2">
			<div class="input-group">
			  <span class="input-group-addon">ID</span>
			  <input type="text" class="form-control" id="idoas" placeholder="Id Material">
			</div>
		</div>

		<div class="col-xs-1 col-md-1"> </div>

		<div class="col-xs-3 col-md-3">

			<form class="form-inline" role="form">
				<div class="form-group">
					<label>Estado:</label>
				    <div class="checkbox">
					    <label>
					      <input class="radio_estado" type="radio" name="estado" value="borrador"> Borrador
					    </label>
					</div>
					<div class="checkbox">
					    <label>
					      <input class="radio_estado" type="radio" name="estado" value="evaluado"> Evaluado
					    </label>
					</div>
				</div>
			</form>
		</div>

		<div class="col-xs-1 col-md-1">

		</div>

		<div class="col-xs-5 col-md-5">
		    <div class="input-group">
		      <input type="text" class="form-control" id="nombre" placeholder="Introduzca nombre o descripción del Material a buscar">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button">Buscar</button>
		      </span>
		    </div>
		</div>
	</div>

	<div class="row">
		<div class="table-responsive"> <!-- Pensar si dejar este div o no.... -->
			<table class="table table-hover table-bordered" id="tabla-oas">
				<thead>
				  	<tr>
						<th width="8%">Id</th>
						<th>Nombre</th>
						<th width="10%">Estado</th>
						<th width="18%">Opciones</th>
				  	</tr>
				</thead>
				<tbody id="table_content">
				<?php
					$query_oas = "SELECT * FROM oas";
					//consulto la consulta
					$tabla_oas = $mysqli->query($query_oas) or die ($mysqli->error. " en la línea ".(__LINE__-1));
					while($registro = $tabla_oas->fetch_assoc()){
				?>
					<tr>
						<td>
							<span><?php echo $registro['id']; ?></span>
						</td>
						<td>
							<span><?php echo $registro['titular']; ?></span>
						</td>
						<td>
							<span><?php echo $registro['estado']; ?></span>
						</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-lg" <?php if(($registro['estado'] == 'Evaluado') || ($registro['estado'] == 'Cancelado*')){
											echo "disabled";
											}?>  onclick="parent.location='evaluacion.php?id=<?php echo $registro['id'];?>&estado=<?php echo $registro['estado'];?>'" data-toggle="EjecutarEvaluacion" title="Evaluar material">
				                    <span class="glyphicon glyphicon-play evaluar" ></span>


				            	</button>
				            	<button type="button" class="btn btn-default btn-lg " <?php if($registro['estado'] == 'Borrador'){
											echo "disabled";
											}?>

				            	onclick="parent.location='descarga_final.php?id=<?php echo $registro['id'];?>'" data-toggle="Descargar" title="Descargar evaluación del material">
				                    <span class="glyphicon glyphicon-download-alt descargar"></span>
				            	</button>
				            	<button type="button" class="btn btn-default btn-lg eoa" id="<?php echo $registro['id']; ?>" data-toggle="Eliminar" title="Eliminar material">
				                    <span class="glyphicon glyphicon-trash icon-remove eliminar"></span>
				            	</button>
			            	</div>
						</td>
					</tr>
				<?php 
					}
					$tabla_oas->free();
					$mysqli->close();
				?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row">
		<button type="button" class="btn btn-default right" data-toggle="modal" data-target="#modalAnnadirOAs">
            <span class="glyphicon glyphicon-plus-sign icon-add annadir"></span>
    	</button>
    </div>
    <br>

    <!--Para añadir un OAs a la tabla-->
    <div class="modal fade" id="modalAnnadirOAs" role="dialog">
	    <div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close cancelarAnnadirOAs" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Añadir un Material</h4>
		        </div>
		        <div class="modal-body" id="camposAltaOAs">
		        	<div class="form-group" id="campoObligatorioAnnadirOA">
					    <label for="nombre">Titulo*</label>
					    <input type="text" class="form-control" id="nombreOAs">
					</div>

					<div class="form-group">
						<label for="descripcion">Descripción y URL</label>
						<textarea class="form-control" rows="4" id="descripcionOAs"></textarea>
					</div>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-default cancelarAnnadirOAs" data-dismiss="modal">Cancelar</button>
		        	<button type="button" class="btn btn-success" id="annadirOAs" onclick = 'annadirOAs();'>Añadir</button>
		          <!--En este boton es donde se pondría para eliminar el criterio de la lista comunicacion con bd y actualizar la tabla-->
		        </div>
	      	</div>
	    </div>
	</div>

	<!--Para eliminar un OAs-->
	<div class="modal fade" id="modalEliminarOAs" role="dialog">
	    <div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Eliminar el Material</h4>
		        </div>
		        <div class="modal-body">
		        	<p>Esta seguro que desea eliminar el Material</p>
		        </div>
		        <div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        	<button type="button" class="btn btn-danger danger" id="eoa">Eliminar</button>
		          <!--En este boton es donde se pondría para eliminar el criterio de la lista comunicacion con bd y actualizar la tabla-->
		        </div>
	      	</div>
	    </div>
  	</div>
</div>

<a href="#" class="scrollup" title="Back to top" > </a>

<?php
	require ('pie.php')
?>