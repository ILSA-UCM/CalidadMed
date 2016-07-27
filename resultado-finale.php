<?php 
require ('php/conexion.php');

$id_oa = $_GET['id_oa'];
$id_item = $_GET['id_item'];
$itemsnum = $_GET['itemsnum'] ;
$minimos = $_GET['minimos'] ;
$aplicable = $_GET['aplicable'] ;
$na = $_GET['na'] ;
$total = $_GET['total'] ;
$id_criterio = $_GET['id_criterio'];
$crit_itemsnum = $_GET['crit_itemsnum'];

if (!empty($_GET['ratio'])) {
	$ratio = $_GET['ratio'] ;
}else{
	$ratio = 0;
}
if (!empty($_GET['observaciones_finales'])) {
	$observaciones_finales = $_GET['observaciones_finales'];
}else{
	$observaciones_finales = "";
}

// SELECT TO CHECK THE STATUS OF ITEM
$infoItemStatus = "SELECT * FROM evaluaciones where id_oa=$id_oa and id_criterio=$id_criterio";
$query_itemStatus = $mysqli->query($infoItemStatus) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
$cmpt = 0;
if ($query_itemStatus->num_rows > 1) {
    // output data of each row
    while($row = $query_itemStatus->fetch_assoc()) {
        if($row['status'] ==1){
		$cmpt++;
	}
    }
} else if($query_itemStatus->num_rows ==1) {
	$row = $query_itemStatus->fetch_row();
	echo $row[6];
    if($row[6] ==1){
		$cmpt=1;
	}else{
		$cmpt=0;
	}
}
$itemsevaluados =0;
// SELECT TO CHECK IF THIS RESULTADO WAS ADDED
$infoItemsitem = "SELECT * FROM resultados where id_oa=$id_oa";
$query_items = $mysqli->query($infoItemsitem) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

$row = $query_items->fetch_row();
if(empty($row)){
	$infoItems = "INSERT INTO resultados (id_oa,itemsnum,minimos,aplicable,na,total,ratio,observaciones_finales,itemsevaluados) VALUES ($id_oa,$itemsnum,$minimos,$aplicable,$na,$total,$ratio,'$observaciones_finales',$row[9])";
	$query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
}else if($cmpt != $crit_itemsnum){
	$itemsevaluados = $row[9]+$crit_itemsnum;
	echo "up".$itemsevaluados;	
	$infoItems = "UPDATE resultados SET id_oa=$id_oa,itemsnum=$itemsnum,minimos=$minimos,aplicable=$aplicable,na=$na,total=$total,ratio=$ratio,observaciones_finales='$observaciones_finales',itemsevaluados=$itemsevaluados WHERE id_oa=$id_oa";
	$query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
}


$infoResultado = "SELECT * FROM resultado where id_oa=$id_oa";
$query_resultado = $mysqli->query($infoResultado) or die ($mysqli->error. " en la línea ".(__LINE__-1));

$infoItems = "UPDATE evaluaciones SET status = 1  WHERE id_oa=$id_oa and id_item= $id_item";
$query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

?>