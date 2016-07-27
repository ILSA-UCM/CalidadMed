<?php	

	require ('php/conexion.php');
	$id = $_GET['id'];
	//$id = 10;

	$docs = "SELECT * FROM docs WHERE id_OA = $id";

	
	$resultado_docs = $mysqli->query($docs) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$contenido= "<?xml version=\"1.0\" ?>\n";

	
	$fila_docs = mysqli_fetch_assoc($resultado_docs);
	$filename= "$fila_docs[nombre]";
	//$filename .= ".xml";
	
	$contenido = $fila_docs['documento'];



 	

if (file_put_contents($filename ,$contenido)){
        
         header("Content-Disposition: atachment; filename=$filename");
 		 readfile($filename);
 		 unlink($filename);

			}

   else{
         print "El fichero todavia no esta creado";
}


    
    ?>