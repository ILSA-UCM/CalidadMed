<?php
	require('cabecera.php');
	require('php/conexion.php');
	$id = $_GET['id'];
	$qcriterio = "SELECT * FROM criterios WHERE id=$id";
	$qitems = "SELECT * FROM items WHERE id_criterio=$id ORDER BY orden";
 
	$query_result = $mysqli->query($qcriterio) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$query_resulti = $mysqli->query($qitems) or die ($mysqli->error. " en la línea ".(__LINE__-1));
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
	<?php while($registro = $query_result->fetch_assoc()){//realmente por como esta la BD esto solo hay 1 registro
	?>
	<div class="row infoCriterio" data-id="<?php echo $registro['id'];?>">
		<br>
		<div class="col-xs-12 col-md-12 well">
			<h2 class="titulo-items centrarTexto">Criterio #<?php echo $registro['orden'];?></h2>
			<h3 class="titulo-criterio centrarTexto underline">
				<b><?php echo $registro['titular_es'];?></b>
			</h3>
			<div class="justificar">
				<span><?php echo $registro['descripcion_es'];?></span>
                <span class="glyphicon glyphicon-pencil editar ec_css" data-toggle="Editar" title="Editar información del criterio"></span>
			</div>
		</div>
	</div>
	<?php
	}
	$query_result->free();
	?>

	<div class="row">
		<div class="col-xs-12 col-md-12">
			<h4><b>Items del Criterio</b></h4>
		</div>
	</div>

	<div class="row">
		<div class="table-responsive"> <!-- Pensar si dejar este div o no.... -->
			<table class="table table-hover table-bordered" id="tabla-items" data-criterio="<?php echo $id; ?>">
				<thead>
				  	<tr>
						<th width="25%">Nombre</th>
						<th>Descripción</th>
						<th width="15%">Opciones</th>
				  	</tr>
				</thead>
				<?php while($registro = $query_resulti->fetch_assoc()){	?>
				<tbody>
					<tr>
						<td>
							<span><?php echo $registro['item_es']; ?></span>
						</td>
						<td>
							<span><?php echo $registro['descripcion_es']; ?></span>
						</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-lg editarItem" data-id="<?php echo $registro['id'];?>" data-toggle="Editar" title="Editar información del item">
				                    <span class="glyphicon glyphicon-pencil editar"></span>
				            	</button>
				            	<button type="button" class="btn btn-default btn-lg eliminarItems" id="<?php echo $registro['id']; ?>" data-toggle="Eliminar" title="Eliminar item">
				                    <span class="glyphicon glyphicon-trash icon-remove eliminar"></span>
				            	</button>
			            	</div>
						</td>
					</tr>
				</tbody>

				<?php 
					}
					$query_resulti->free();
					$mysqli->close();
				?>

			</table>
		</div>
	</div>

	<div class="row">
		<button type="button" class="btn btn-default right" data-toggle="modal" data-target="#modalAnnadirItems">
            <span class="glyphicon glyphicon-plus-sign icon-add annadir"></span>
    	</button>
    </div>

    <br>

	<!--Para añadir un item a la tabla-->
    <div class="modal fade" id="modalAnnadirItems" role="dialog">
	    <div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close cancelarAnnadirItems" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Añadir un Items al Criterio</h4>
		        </div>
		        <div class="modal-body" id="camposAltaItems">
		        	<div class="form-group campoObligatorioNombreItems">
					    <label for="nombre">Nombre*</label>
					    <input type="text" class="form-control" id="nombreItems">
					</div>

					<div class="form-group campoObligatorioDescripcionItems">
						<label for="descripcion">Descripción*</label>
						<textarea class="form-control" rows="4" id="descripcionItems"></textarea>
					</div>

					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="nivel del item" class="col-lg-1 control-label">Nivel</label>
    						<div class="col-lg-2">
								<select name="nivelItems" class="nivelItems form-control">
									<option value="M">M</option>
									<option value="E">E</option>
								</select>
							</div>
						</div>
					</form>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-default cancelarAnnadirItems" data-dismiss="modal">Cancelar</button>
		        	<button type="button" class="btn btn-success" id="annadirItems" data-criterio="<?php echo $id;?>" onclick = 'annadirItems();'>Añadir</button>
		          <!--En este boton es donde se pondría para eliminar el criterio de la lista comunicacion con bd y actualizar la tabla-->
		        </div>
	      	</div>
	    </div>
	</div>

	<!--Para editar La información del criterio-->
	<div class="modal fade" id="modalEditarInfoCriterio" role="dialog">
		<div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        
	      	</div>
	    </div>
	</div>

	<!--Para editar La información del items del criterio-->
	<div class="modal fade" id="modalEditarInfoItem" role="dialog">
		<div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        
	      	</div>
	    </div>
	</div>

</div>

<a href="#" class="scrollup" title="Back to top" > </a>

<?php
	require('pie.php');
?>