<?php
    require('php/conexion.php');

    $id_item = $_GET['id_item'];
    $id_oa = $_GET['id_oa'];
    $na = $_GET['na'];

    $infoItems = "UPDATE evaluaciones SET no_applicable = $na WHERE id_item=$id_item and id_OA=$id_oa";
    
    $query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
?>
