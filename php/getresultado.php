<?php 
require ('php/conexion.php');

$id = $_GET['id'];

$infoItemsitem = "SELECT * FROM evaluaciones WHERE id_criterio=$id";

$query_items = $mysqli->query($infoItemsitem) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

$minimos = 0;$total =0;$numitems=0;$noapl = 0; 

while ($items = $query_items->fetch_assoc()) {

if($items['nivel'] == 'M')
    $minimos++;

$total +=$items['puntuacion'];
$numitems++;

}
?>
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
        <td><input class="id_this_criterio hidden" value="<?php echo $id;?>"></td>
        <td><input class="minimos_<?php echo $id;?> form-control" value="<?php echo $minimos; ?>" disabled></td>
        <td><input class="total_<?php echo $id;?> form-control" value="<?php echo $total; ?>" disabled></td>
        <td><input class="na_<?php echo $id;?> form-control" value="<?php echo $numitems-$minimos;?>" disabled></td>
        <td>
            <input id="btn" type="button" input="update" class="btn btn-primary actualizar-item" value="Actualizar creterios">
        </td>
        </tr>
    </tbody>
</table>