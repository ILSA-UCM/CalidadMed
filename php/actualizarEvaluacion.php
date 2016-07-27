<?php
	require('conexion.php');
	//require('../js/nuestras_funciones.js');

	$criterio = $_GET['id_criterio'];
	$item = $_GET['id_item'];
	$objeto = $_GET['id_oa'];
	$nivel = $_GET['nivel'];
	$puntuacion = $_GET['puntuacion'];
	$observacion = $_GET['observacion'];

	//escape de las entradas del usuario para prevenir SQL Injection
	$observacion = mysql_real_escape_string($observacion);

	$query = "UPDATE evaluaciones SET nivel='$nivel', puntuacion=$puntuacion, observaciones='$observacion' WHERE id_criterio=$criterio and id_item=$item and id_oa=$objeto";
	$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$infoItemsitem = "SELECT * FROM evaluaciones WHERE id_criterio=$criterio";

	$query_items = $mysqli->query($infoItemsitem) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$minimos = 0;$total =0;$numitems=0;$noapl = 0; 

	while ($items = $query_items->fetch_assoc()) {

	if($items['nivel'] == 'M')
	    $minimos++;

	$total +=$items['puntuacion'];
	$numitems++;

	}
?>
<!-- <table class="table table-hover SubTotalCriterio">
    <thead>
      <tr>
        <th>TOTAL CRITERIO</th>
        <th>MINIMOS</th>
        <th>TOTAL</th> 
        <th>NÚMERO DE ITEMS NO APLICABLES</th>
      </tr>
    </thead>
    <tbody>
        <tr>
        <td><input class="id_this_criterio hidden" value="<?php echo $id;?>"></td>
        <td><input class="minimos_<?php echo $id;?> form-control" value="<?php echo $minimos; ?>" disabled></td>
        <td><input class="total_<?php echo $id;?> form-control" value="<?php echo $total; ?>" disabled></td>
        <td><input class="na_<?php echo $id;?> form-control" value="<?php echo $numitems-$minimos;?>" disabled></td>
        <td>
            <input id="btn" type="button" input="update" class="btn btn-primary actualizar-item" value="Actualizar creterios">
        </td>
        </tr>
    </tbody>
</table> -->