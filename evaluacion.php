<?php
	require ('cabecera.php');
	require ('php/conexion.php');
	$id = $_GET['id'];
	$estado = $_GET['estado'];
	//$nombre = $_Get['Nombre'];

	$infoCri = "SELECT criterios.id, criterios.titular_es, criterios.descripcion_es,criterios.orden FROM evaluaciones, criterios WHERE evaluaciones.id_OA=$id and evaluaciones.id_criterio=criterios.id GROUP by criterios.orden";
	$query_criterios = $mysqli->query($infoCri) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	//Para no poner el id usao una valiable que me que se vaya incrementando de un dígito en uno
	$contador = 1;

	$num_criterios = $query_criterios->num_rows;
	echo $num_criterios;

	// SELECT TO CHECK IF THIS RESULTADO WAS ADDED
	$infoItemsitem = "SELECT * FROM rango where id=1";
	$query_items = $mysqli->query($infoItemsitem) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$row = $query_items->fetch_row();
	$pun_min = $row['1'];
	$pun_max = $row['2'];
?>

<input type="text" class="hidden the_id_of_this_evluacion" value="<?php echo $id; ?>">
<input type="text" class="hidden the_id_of_this_guardar" value="<?php echo $id; ?>">
<input type="text" class="hidden the_id_of_this_descargar" value="<?php echo $id; ?>">

<!--Esto solo es para cambiar el active del navbar-->
<script type="text/javascript">
	$(".navbar-nav li").each(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        }
    });
	$("#oas").addClass("active");
	actualizarBarEstado() 
</script>

<div class="container">
	<div class="row">
		<div class="row step">
			<?php while ($contador <= $num_criterios) { ?>
				<?php if($contador==1){?>
					<div class="col-md-2 activestep" onclick="javascript: resetActive(event, 'step-<?php echo $contador;?>');">
				<?php }else{ ?>
					<div class="col-md-2" onclick="javascript: resetActive(event,'step-<?php echo $contador; ?>');">
				<?php } ?>
					<p>Criterio <?php echo $contador; ?></p>
				</div>
				<?php 
				$contador++;
			}
			if($contador == ($num_criterios+1)){ ?>
				<div class="col-md-2 save-resultado" onclick="javascript: resetActive(event,'step-<?php echo $contador; ?>');">
					<p>Resultado</p>
				</div>
			<?php }?>
		</div>
	</div>
</div>


<div class="container barStado" data-numCriterios=<?php echo $num_criterios; ?> >
	<div class="row">
		<div class="col-xs-10 col-md-10">
			<div class="progress">
				<!--<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:70%" > 0% </div>-->
			</div>
		</div>
		<div class="btn-group">
			<button type="button" class="btn btn-default btn-lg guardar" data-toggle="GuardarBorrador" title="Guardar Borrador">
				<span class="glyphicon glyphicon-floppy-disk"></span>
			</button>
			<button type="button" class="btn btn-default btn-lg evaluar" data-toggle="Evaluar" title="Evaluar material">
				<span class="glyphicon glyphicon-cloud-upload"></span>
			</button>

			<button type="button" class="btn btn-default btn-lg descargar" data-toggle="Descargar" title="Descargar" onclick="parent.location='descargar.php?id=<?php echo $id ?>'">
				<span class="glyphicon glyphicon-download-alt"></span>
			</button>
		</div>
	</div>
</div>
<div class="container">	
		<div class="row">
			<?php
			$contador=1;
			while($criterios = $query_criterios->fetch_assoc()){
				if($contador == 1){
			?>
			<div class="col-xs-12 col-md-12 setup-content step activeStepInfo" id="step-<?php echo $contador;?>">
			<?php }else{ ?>
			<div class="col-xs-12 col-md-12 setup-content step hiddenStepInfo" id="step-<?php echo $contador;?>">	
			<?php } ?>
				<div class="well text-center">
					<h1>Criterio <?php echo $contador;?></h1>
					<h3 class="underline">
						<b> <?php echo $criterios['titular_es'];?></b>
					</h3>
					<p class="justificar">
						<?php echo $criterios['descripcion_es'];?>
					</p>

					<div class="table-responsive"> <!-- Pensar si dejar este div o no.... -->
						<?php 
						$infoItems = "SELECT evaluaciones.id_item,evaluaciones.id_OA,evaluaciones.puntuacion, evaluaciones.observaciones,evaluaciones.no_applicable,items.item_es, items.descripcion_es,items.nivel,items.id_criterio,items.orden FROM evaluaciones, items WHERE evaluaciones.id_OA=$id and evaluaciones.id_item=items.id and evaluaciones.id_criterio=items.id_criterio and evaluaciones.id_criterio=".$criterios['id']." and items.id_criterio=".$criterios['id']." GROUP by items.orden";
						$query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
						?>
						<table class="table table-hover table-borderless evaluacion_criterio" data-oa=<?php echo $id;?> data-criterio=<?php echo $criterios['id'];?>>
							<thead>
							  <tr>
							  	<th width="0%"></th>
								<th width="30%">Item</th>
								<th width="5%">Nivel</th>
								<th width="7%">Puntuaci&oacute;n</th>
								<th width="10%">No Aplicable </th>
								<th width="48%">Observaciones</th>
							  </tr>
							</thead>
							<?php $minimos = 0;$total =0;$numitems=0;$noapl = 0; ?>
							<tbody>
							<?php while ($items = $query_items->fetch_assoc()) { ?>
							<?php
								if($items['nivel'] == 'M')
							        $minimos++;
							    if($items['no_applicable'] == 1)
							        $noapl++;

								$total +=$items['puntuacion'];
								$numitems++; ?>
								<tr class="class_criterio class_item" data-item=<?php echo $items['id_item'];?>>
									<td>
										<input type="text" class="id_this_item hidden" value="<?php echo $items['id_item'];?>">
									</td>
									<td>
										<p class="justificar">
											<label><?php echo $items['item_es'];?></label>
											<span class="glyphicon glyphicon-info-sign oculto<?php echo $items['id_item'];?>" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal<?php echo $items['id_item'];?>"></span>
											<!-- Button trigger modal -->
										

										<!-- Modal -->
										<div class="modal fade" id="myModal<?php echo $items['id_item'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										  <div class="modal-dialog modalInfoEitem" role="document">
										    <div class="modal-content">
										      <div class="modal-body">
										        <?php echo $items['descripcion_es'];?>
										      </div>
										    </div>
										  </div>
										</div>
										</p>
									</td>
									<td>
										<b class="nivel"><?php echo $items['nivel']; ?></b>
									</td>
										
									<td>
										<select  class="puntuacion form-control" data-oa=<?php echo $id;?> data-criterio=<?php echo $criterios['id'];?>  data-item=<?php echo $items['id_item'];?> <?php if($items['no_applicable'] == 1){ echo "disabled";}?>>
										<?php for($i=$pun_min;$i<=$pun_max;$i++){ ?>
										<option value="<?php echo $i ;?>" <?php if($items['puntuacion'] == $i) echo "selected"; ?>> <?php echo $i; ?></option>
										<?php } ?>
										</select>
									</td>

									<td>
										<input type="checkbox" class="no_applicable_select" name="check"  data-criterio=<?php echo $criterios['id'];?> <?php if($items['no_applicable'] == 1){ echo "checked";}?> data-oa=<?php echo $id;?> data-item=<?php echo $items['id_item'];?>>	

									</td>
									<td style="dispaly:block;">
										<div class="form-group justificar">
										  <textarea class="form-control observaciones" rows="3" placeholder="Escriba las observaciones que tenga respecto a este item; recuerde que si el nivel marcado es NA, entonces tendra que llenar este campo necesariamente" data-oa=<?php echo $id;?> data-item=<?php echo $items['id_item'];?>><?php echo $items['observaciones'];?></textarea>
										</div>
									</td>
								</tr>
							
							<?php } ?>
							</tbody>
							<?php $query_items->free();
							?>
						</table>
					</div>

					<br>
					<div class="SingleTotalCriterio">
					<table class="table table-hover SubTotalCriterio">
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
                        	 <td><input class="id_this_criterio hidden" value="<?php echo $criterios['id'];?>" ></td>

                            <td><input class="minimos_<?php echo $criterios['id'];?> form-control" value="<?php echo $minimos; ?>" disabled></td>
                            <td><input class="total_<?php echo $criterios['id'];?> form-control total_pun" value="<?php echo $total; ?>" disabled></td>
                            <td><input class="na_<?php echo $criterios['id'];?> form-control total_na" value="<?php echo $noapl ;?>" disabled></td>
                            </tr>
                        </tbody>
                    </table>

					</div>
					<button class="save_this_criterio btn btn-primary" data-criterio="<?php echo $criterios['id'];?>" data-oa="<?php echo $id;?>" data-numItem="<?php echo $numitems; ?>"> Guardar Criterio </button>
				</div>
			</div>
			
			<?php 
			$contador++;
			} //termina el while de los criterios
			?>
			<?php if($contador == ($num_criterios+1)){ 
			$infoResultado = "SELECT * FROM resultado where id_oa=$id order by id_criterio";
			$query_resultado = $mysqli->query($infoResultado) or die ($mysqli->error. " en la línea ".(__LINE__-1));
			?>
			<div class="col-xs-12 col-md-12 setup-content setup-resultado step hiddenStepInfo" id="step-<?php echo $contador;?>">
			<table class="table SubTotalCriterio">
			    <thead>
			      <tr>
			        <th>CRITERIOS</th>
			        <th>MINIMOS</th>
			        <th>TOTAL</th> 
			        <th>NÚMERO DE ITEMS NO APLICABLES</th>
			      </tr>
			    </thead>
			    <tbody>
			        <?php 
					$cmpt=0;
			        // $total_min=0;$total_na=0;$totals=0;$total_pun=0;
			        $total_min=0;$total_na=0;$totals=0;$total_pun=0;$cmpt=0;
			        while ($row = $query_resultado->fetch_assoc()) { 
					$cmpt++;
			        $total_min+=$row['minimos'];
			        $totals+=$row['total'];
			        $total_na+=$row['no_aplicables'];?>
			        <tr>
			        <td><input class="id hidden" value="<?php echo $row['id'];?>">CRITERIO <?php echo $cmpt; ?></td>
			        <td><input class="minimos  form-control" value="<?php echo $row['minimos']; ?>" disabled></td>
			        <td><input class="total  form-control" value="<?php echo $row['total']; ?>" disabled></td>
			        <td><input class="na  form-control" value="<?php echo $row['no_aplicables'];?>" disabled></td>
			        </tr>
			        <?php } ?>
			    </tbody>
			</table>
			<?php
	// ID OF THIS OA
    $objeto = $_GET['id'];

    // SELECT FROM EVALUACIONES
    $infoItemsitem = "SELECT * FROM evaluaciones WHERE id_OA=$objeto";
    $query_items = $mysqli->query($infoItemsitem) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

    // SELECT FROM RESULTADOS
    $infoResultado = "SELECT * FROM resultados WHERE id_oa=$objeto";
    $query_infoResultado = $mysqli->query($infoResultado) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
    $row_resultado = $query_infoResultado->fetch_row();

    // SELECT FROM ITEM and EVALUACIONES
	$infoItems = "SELECT  evaluaciones.id_item,evaluaciones.id_OA,evaluaciones.puntuacion, evaluaciones.observaciones,evaluaciones.no_applicable,items.item_es, items.descripcion_es,items.nivel,items.id_criterio FROM evaluaciones, items WHERE evaluaciones.id_OA=$objeto and evaluaciones.id_criterio=items.id_criterio  and evaluaciones.id_item=items.id";
	$query_itemsTotal = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
	
	// INISIALIZATION OF VARIABLE			
    $minimos = 0;$total =0;$numitems=0;$noapl = 0;$itemsnum=0;$aplicable=0;$totalapl=0;$totalminimos=0;$totalnoapl=0;

    // WHILE To GET NUMITEMS and TOTAL PUNCTUACION 
    // 				========     =================
    while ($items = $query_items->fetch_assoc()) {
	    $itemsnum++;
	    $total +=$items['puntuacion'];
	    $numitems++;
    }

	// WHILE To GET MINIMOS
	// 				=======
    while ($itemstotal = $query_itemsTotal->fetch_assoc()) {
    if($itemstotal['nivel'] == 'M'){
    	$minimos++;
    	$totalminimos = $itemstotal['puntuacion'];
    }
    if($itemstotal['no_applicable'] == 1){
    	$noapl++;
    }
	}
	$itemapp = $itemsnum-$noapl;
	if ($itemapp != 0) {
		$ratio=$total/$itemapp;
	}else{
		$ratio = 0;
	}
    

?>

<table class="table SubTotalCriterio">
    <thead>
      <tr>
        <th>ITEMS</th>
        <th>MINIMOS</th>
        <th>NÚMERO DE ITEMS APLICABLES</th> 
        <th>NÚMERO DE ITEMS NO APLICABLES</th>
        <th>TOTAL PUNTUACION</th>
        <th>RATIO</th>
        <th>ITEMSEVALUADOS</th>
      </tr>
    </thead>
    <tbody>
        <tr>
        <td><input class="itemsnum form-control"  value="<?php echo $itemsnum;?>"disabled/></td>
        <td><input class="minimos form-control" value="<?php echo $minimos; ?>" disabled></td>
        <td><input class="aplicable form-control"  value="<?php echo ($itemsnum-$noapl);?>" disabled/></td>
        <td><input class="na form-control" value="<?php echo $noapl ;?>" disabled></td>
        <td><input class="total form-control" value="<?php echo $total; ?>" disabled></td>
        <td><input class="ratio form-control"  value="<?php echo round($ratio, 2);?>" disabled/></td>
        <td class="itemsevaluados_td"><input class="itemsevaluados form-control" value="<?php $cero=0; if(isset($row_resultado[9])) echo $row_resultado[9]; else echo $cero;?>" disabled/></td>
        </tr>

        <tr>
        	<td colspan="6">
        		<div class="form-group justificar">
        			<label for="observaciones globales">OBSERVACIONES FINALES</label>
        			<textarea class="observaciones_finales form-control" rows="2" placeholder="Escriba las observaciones globales a la evaluación que desee guardar" <?php if($estado == 'Evaluado'){
						echo "disabled";
					}?>><?php echo $row_resultado[8];?></textarea>
				</div>
			</td>
			<td><button class="save_finales btn btn-primary"> Guardar observaciones globales</button></td>
        </tr>

    </tbody>
</table>
			</div>
			<?php }
			$query_criterios->free();
			$mysqli->close();
			?>
		</div>
</div>
<a href="#" class="scrollup" title="Back to top" > </a>

<?php
	require ('pie.php')
?>