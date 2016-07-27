<?php 
require ('php/conexion.php');
// Unescape the string values in the JSON array
$tableData = stripcslashes($_POST['itemsata']);
// Decode the JSON array
$tableData = json_decode($tableData,TRUE);

$id_criterio = $_GET['id_criterio'];
if (isset($_GET['id_oa'])) {
$id_oa = (int)$_GET['id_oa'];
}


$arr_length = count($tableData);

for($i=0;$i<$arr_length;$i++)
{
	$pun = $tableData[$i]['puntuacion'];
	$obs = $tableData[$i]['observaciones'];
	$nop = $tableData[$i]['no_applicable'];
	$itm = $tableData[$i]['id_item'];

	if(empty($obs)){
		$infoItems = "UPDATE evaluaciones SET puntuacion=$pun,no_applicable=$nop,status=1 WHERE id_criterio=$id_criterio and id_OA=$id_oa and id_item=$itm";
	}else{
		$infoItems = "UPDATE evaluaciones SET puntuacion=$pun,observaciones='$obs',no_applicable=$nop,status=1 WHERE id_criterio=$id_criterio and id_OA=$id_oa and id_item=$itm";
	}	
    $query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

}

?>