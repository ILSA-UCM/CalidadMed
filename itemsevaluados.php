<?php
    require('php/conexion.php');

    $id = $_GET['id_oa'];
    $infoItems = "SELECT * FROM resultados WHERE id_oa=$id";
    $query_items = $mysqli->query($infoItems) or die or die ($mysqli->error. " en la línea ".(__LINE__-1));
    $row = $query_items->fetch_row();
?>
<input class="itemsevaluados form-control" value="<?php echo $row[9]; ?>" disabled="">