<?php require ('php/conexion.php');

//The beginng of All Search content 

 if ( (isset($_GET['titular']) && empty($_GET['titular'])) || (isset($_GET['estado']) && empty($_GET['estado'])) || (isset($_GET['id_oas']) && empty($_GET['id_oas']))) :

$query_oas = "SELECT * FROM oas";
$tabla_oas = $mysqli->query($query_oas) or die ($mysqli->error. " en la línea ".(__LINE__-1));
if ($tabla_oas->num_rows >= 0) : ?>
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
<?php	while($registro = $tabla_oas->fetch_assoc()){
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
							}?>  onclick="parent.location='evaluacion.php?id=<?php echo $registro['id'];?>&estado=<?php echo $registro['estado'];?>'"> <!-- id="< echo $registro['id']; ?>"> -->
                    <span class="glyphicon glyphicon-play evaluar" ></span>


            	</button>
            	<button type="button" class="btn btn-default btn-lg " <?php if($registro['estado'] == 'Borrador'){
							echo "disabled";
							}?>

            	onclick="parent.location='descarga_final.php?id=<?php echo $registro['id'];?>'">
                    <span class="glyphicon glyphicon-download-alt descargar"></span>
            	</button>
            	<button type="button" class="btn btn-default btn-lg eoa" id="<?php echo $registro['id']; ?>">
                    <span class="glyphicon glyphicon-trash icon-remove eliminar"></span>
            	</button>
        	</div>
		</td>
	</tr>
	<?php 
	}
	$tabla_oas->free();?>
	</tbody>
</table>
<?php endif;?>
<?php endif; 

//The end of All Search content 
?>


<?php

//The beginng of Id Search content 

if (isset($_GET['id_oas']) && ($_GET['id_oas'] != '')) {

$query_oas = "SELECT * FROM oas where id =".$_GET['id_oas'];
$tabla_oas = $mysqli->query($query_oas) or die ($mysqli->error. " en la línea ".(__LINE__-1));

if ($tabla_oas->num_rows >= 0) : ?>
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
<?php	while($registro = $tabla_oas->fetch_assoc()){
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
							}?>  onclick="parent.location='evaluacion.php?id=<?php echo $registro['id'];?>&estado=<?php echo $registro['estado'];?>'"> <!-- id="< echo $registro['id']; ?>"> -->
                    <span class="glyphicon glyphicon-play evaluar" ></span>


            	</button>
            	<button type="button" class="btn btn-default btn-lg " <?php if($registro['estado'] == 'Borrador'){
							echo "disabled";
							}?>

            	onclick="parent.location='descarga_final.php?id=<?php echo $registro['id'];?>'">
                    <span class="glyphicon glyphicon-download-alt descargar"></span>
            	</button>
            	<button type="button" class="btn btn-default btn-lg eoa" id="<?php echo $registro['id']; ?>">
                    <span class="glyphicon glyphicon-trash icon-remove eliminar"></span>
            	</button>
        	</div>
		</td>
	</tr>
	<?php 
	}?>
	</tbody>
</table>
<?php endif;
}


//The end of Id Search content 

//The Beginng  of Estado Search content 

if (isset($_GET['estado'])) {

$query_oas = "SELECT * FROM oas where estado='".$_GET['estado']."'";
$tabla_oas = $mysqli->query($query_oas) or die ($mysqli->error. " en la línea ".(__LINE__-1));

if ($tabla_oas->num_rows >= 0) : ?>
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
<?php	while($registro = $tabla_oas->fetch_assoc()){
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
							}?>  onclick="parent.location='evaluacion.php?id=<?php echo $registro['id'];?>&estado=<?php echo $registro['estado'];?>'"> <!-- id="< echo $registro['id']; ?>"> -->
                    <span class="glyphicon glyphicon-play evaluar" ></span>


            	</button>
            	<button type="button" class="btn btn-default btn-lg " <?php if($registro['estado'] == 'Borrador'){
							echo "disabled";
							}?>

            	onclick="parent.location='descarga_final.php?id=<?php echo $registro['id'];?>'">
                    <span class="glyphicon glyphicon-download-alt descargar"></span>
            	</button>
            	<button type="button" class="btn btn-default btn-lg eoa" id="<?php echo $registro['id']; ?>">
                    <span class="glyphicon glyphicon-trash icon-remove eliminar"></span>
            	</button>
        	</div>
		</td>
	</tr>
	<?php 
	}?>
	</tbody>
</table>
<?php endif;
}

//The end  of Estado Search content 

//The Beginng  of nombre Search content 

if (isset($_GET['nombre'])) {

$query_oas = "SELECT * FROM oas where titular LIKE '%".$_GET['nombre']."%'";
$tabla_oas = $mysqli->query($query_oas) or die ($mysqli->error. " en la línea ".(__LINE__-1));

if ($tabla_oas->num_rows >= 0) : ?>
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
<?php	while($registro = $tabla_oas->fetch_assoc()){
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
							}?>  onclick="parent.location='evaluacion.php?id=<?php echo $registro['id'];?>&estado=<?php echo $registro['estado'];?>'"> <!-- id="< echo $registro['id']; ?>"> -->
                    <span class="glyphicon glyphicon-play evaluar" ></span>


            	</button>
            	<button type="button" class="btn btn-default btn-lg " <?php if($registro['estado'] == 'Borrador'){
							echo "disabled";
							}?>

            	onclick="parent.location='descarga_final.php?id=<?php echo $registro['id'];?>'">
                    <span class="glyphicon glyphicon-download-alt descargar"></span>
            	</button>
            	<button type="button" class="btn btn-default btn-lg eoa" id="<?php echo $registro['id']; ?>">
                    <span class="glyphicon glyphicon-trash icon-remove eliminar"></span>
            	</button>
        	</div>
		</td>
	</tr>
	<?php 
	}?>
	</tbody>
</table>
<?php endif;?>

<?php
}