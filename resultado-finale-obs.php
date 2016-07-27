<?php 
require ('php/conexion.php');

$id_oa = $_GET['id_oa'];
$itemsnum = $_GET['itemsnum'] ;
$minimos = $_GET['minimos'] ;
$aplicable = $_GET['aplicable'] ;
$na = $_GET['na'] ;
$total = $_GET['total'] ;

if (!empty($_GET['ratio'])) {
	$ratio = $_GET['ratio'] ;
}else{
	$ratio = 0;
}
if (!empty($_GET['itemsevaluados'])) {
	$itemsevaluados = $_GET['itemsevaluados'] ;
}else{
	$itemsevaluados = 0;
}
if (!empty($_GET['observaciones_finales'])) {
	$observaciones_finales = $_GET['observaciones_finales'];
}else{
	$observaciones_finales = "";
}


// SELECT TO CHECK IF THIS RESULTADO WAS ADDED
$infoItemsitem = "SELECT * FROM resultados where id_oa=$id_oa";
$query_items = $mysqli->query($infoItemsitem) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

$row = $query_items->fetch_row();
if(empty($row)){
	$infoItems = "INSERT INTO resultados (id_oa,itemsnum,minimos,aplicable,na,total,ratio,observaciones_finales,itemsevaluados) VALUES ($id_oa,$itemsnum,$minimos,$aplicable,$na,$total,$ratio,'$observaciones_finales',$itemsevaluados)";
}else{
	echo "up".$itemsevaluados;	
	$infoItems = "UPDATE resultados SET id_oa=$id_oa,itemsnum=$itemsnum,minimos=$minimos,aplicable=$aplicable,na=$na,total=$total,ratio=$ratio,observaciones_finales='$observaciones_finales',itemsevaluados=$itemsevaluados WHERE id_oa=$id_oa";
}
$query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

$infoResultado = "SELECT * FROM resultado where id_oa=$id_oa";
$query_resultado = $mysqli->query($infoResultado) or die ($mysqli->error. " en la línea ".(__LINE__-1));

?>