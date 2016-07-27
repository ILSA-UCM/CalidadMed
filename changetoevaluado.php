<?php 
require ('php/conexion.php');
$id_oa = $_GET['id'];
$infoItems = "UPDATE oas SET estado='Evaluado' where id=$id_oa";
$query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));

?>