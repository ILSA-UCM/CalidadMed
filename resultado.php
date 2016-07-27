<?php 
require ('php/conexion.php');

$id_criterio = $_GET['id_criterio'];
$id_oa = $_GET['id_oa'];
$minimos = $_GET['minimos'];
$total = $_GET['total'];
$no_aplicables = $_GET['no_aplicables'];

$infoItemsitem = "SELECT * FROM resultado where id_criterio=$id_criterio and id_oa=$id_oa";

$query_items = $mysqli->query($infoItemsitem) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

$row = mysqli_fetch_row($query_items);

if(empty($row))
	$infoItems = "INSERT INTO resultado (id_criterio,id_oa,minimos,total,no_aplicables) VALUE ($id_criterio,$id_oa,$minimos,$total,$no_aplicables)";
else
	$infoItems = "UPDATE resultado SET minimos=$minimos,total=$total,no_aplicables=$no_aplicables WHERE id_criterio=$id_criterio and id_oa=$id_oa";

$query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

$infoResultado = "SELECT * FROM resultado where id_oa=$id_oa";
$query_resultado = $mysqli->query($infoResultado) or die ($mysqli->error. " en la línea ".(__LINE__-1));

?>
<table class="table SubTotalCriterio">
    <thead>
      <tr>
        <th>TOTAL CRITERIO</th>
        <th>MINIMOS</th>
        <th>TOTAL</th> 
        <th>NÚMERO DE ITEMS NO APLICABLES</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $cmpt=0;
        $total_min=0;$total_na=0;$totals=0;$total_pun=0;$cmpt=0;
        while ($row = $query_resultado->fetch_assoc()) { 
            $cmpt++;
        $total_pun++;
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
    $objeto = $id_oa;

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
    //              ========     =================
    while ($items = $query_items->fetch_assoc()) {
    $itemsnum++;
    $total +=$items['puntuacion'];
    $numitems++;
    }

    // WHILE To GET MINIMOS
    //              =======
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
    if ($itemapp != 0)
    $ratio=$total/$itemapp;
    else
    $ratio = 0;

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
        <td class="itemsevaluados_td"><input class="itemsevaluados form-control"  value="<?php echo $row_resultado[9];?>" disabled/></td>
        </tr>

        <tr>
            <td colspan="6">
                <div class="form-group justificar">
                    <label for="observaciones globales">OBSERVACIONES FINALES</label>
                    <textarea class="observaciones_finales form-control" rows="2" placeholder="Escriba las observaciones globales a la evaluación que desee guardar"><?php echo $row_resultado[8];?></textarea>
                </div>
            </td>
            <td><button class="save_finales btn btn-primary"> Guardar observaciones globales</button></td>
        </tr>
    </tbody>
</table>