<?php	

	require ('php/conexion.php');
	$id_oa = $_GET['id'];
	
	
	$tabulador = "	";
	
	$oas = "SELECT * FROM oas WHERE oas.id = $id_oa";
	
	$criterios = "SELECT * FROM criterios ORDER BY orden" ;
	
	$materialFinal = "SELECT * FROM resultados WHERE resultados.id_oa = $id_oa ";
	
	$resultado_oas = $mysqli->query($oas) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$resultado_criterios = $mysqli->query($criterios) or die ($mysqli->error. " en la línea ".(__LINE__-1));

	$resultado_materialFinal = $mysqli->query($materialFinal) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	
	$fila_oas = mysqli_fetch_assoc($resultado_oas);
	
	$filename= "$fila_oas[titular]";

 	$xml= "<?xml version=\"1.0\" ?>\n";

 	$xml.= "<material>\n";
		$xml .= $tabulador;
		$xml.= "<idMaterial>";
			$xml.= "$fila_oas[id]";
		$xml.= "</idMaterial>\n";
		
		$xml .= $tabulador;
		$xml.= "<titulo>";
			$xml.= "$fila_oas[titular]";
		$xml.= "</titulo>\n";
		
		$xml .= $tabulador;
		$xml.= "<descripcion>";
			$xml.= $fila_oas['descripcion'];
		$xml.= "</descripcion>\n";

		$xml .= $tabulador;
		$xml.= "<evaluacion>\n";

		while($row = mysqli_fetch_assoc($resultado_criterios)){
			$idCriterio= "$row[id]";
			
			$xml .= $tabulador;$xml .= $tabulador;
			$xml.= "<criterio>\n";
			
				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml.= "<id>";
					$xml.= "$row[id]";
				$xml.= "</id>\n";
				
				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml.= "<tituloCriterio>";
					$xml.= "$row[titular_es]";
				$xml.= "</tituloCriterio>\n";
				
				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml.= "<descripcionCriterio>";
					$xml.= "$row[descripcion_es]";
				$xml.= "</descripcionCriterio>\n";
												
				$items = "SELECT items.id, items.item_es, items.descripcion_es, items.nivel, items.id_criterio FROM items where items.id_criterio=$idCriterio ORDER BY orden";
				$resultado_items = $mysqli->query($items) or die ($mysqli->error. " en la línea ".(__LINE__-1));

				while(($row= mysqli_fetch_assoc($resultado_items))){
					
					$idItem = "$row[id_criterio]";
					$idItemEvaluacion = "$row[id]";
					$nivel = "$row[nivel]";
					
					$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
					$xml.= "<item>\n";
					
						$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
						$xml.= "<id>";
							$xml.= "$row[id]";
						$xml.= "</id>\n";
						
						$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
						$xml.= "<tituloItem>";
							$xml.= "$row[item_es]";
						$xml.= "</tituloItem>\n";

						$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
						$xml.= "<descripcionItem>";
							$xml.= "$row[descripcion_es]";
						$xml.= "</descripcionItem>\n";

						$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
						$xml.= "<nivel>";
							$xml.= "$row[nivel]";
						$xml.= "</nivel>\n";
					
						$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
						$xml.= "<resultadoItem>\n";

						$evaluacion = "SELECT evaluaciones.puntuacion, evaluaciones.observaciones FROM evaluaciones
						WHERE evaluaciones.id_oa=$id_oa  and evaluaciones.id_criterio=$idCriterio and evaluaciones.id_item= $idItemEvaluacion";

						$resultado_evaluacion = $mysqli->query($evaluacion) or die ($mysqli->error. " en la línea ".(__LINE__-1));

						while(($row= mysqli_fetch_assoc($resultado_evaluacion))){
								
							$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;	
							$xml.= "<puntuacion>";
								$xml.= "$row[puntuacion]";
							$xml.= "</puntuacion>\n";
							
							$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
							$xml.= "<observaciones>";
								$xml.= "$row[observaciones]";
							$xml.= "</observaciones>\n";																																	
						}
						
						$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
						$xml.= "</resultadoItem>\n";
					$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;	
					$xml.= "</item>\n";
		
				}

				$resultadoCriterio = "SELECT resultado.minimos, resultado.total, resultado.no_aplicables FROM resultado, criterios where resultado.id_oa = $id_oa and resultado.id_criterio = $idCriterio ";
				$resultado_resultadoCriterio = $mysqli->query($resultadoCriterio) or die ($mysqli->error. " en la línea ".(__LINE__-1));

				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml.= "<resultadoCriterio>\n";

				$row = mysqli_fetch_assoc($resultado_resultadoCriterio);
				
					$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
					$xml.= "<puntuacion>";
						$xml.= "$row[total]";
					$xml.= "</puntuacion>\n";

					$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
					$xml.= "<minimosCumplidos>";
						$xml.= "$row[minimos]";
					$xml.= "</minimosCumplidos>\n";

					$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
					$xml.= "<noAplicables>";
						$xml.= "$row[no_aplicables]";
					$xml.= "</noAplicables>\n";

				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml.= "</resultadoCriterio>\n";
			
			$xml .= $tabulador;$xml .= $tabulador;
			$xml.= "</criterio>\n";
		}

			
			$fila_material = mysqli_fetch_assoc($resultado_materialFinal);

			$xml .= $tabulador;$xml .= $tabulador;
			$xml .= "<resultadoMaterial>\n";
				
				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml.= "<totalPuntuacion>";
					$xml.= "$fila_material[total]";
				$xml.= "</totalPuntuacion>\n";

				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml.= "<totalMinimosCumplidos>";
					$xml.= "$fila_material[minimos]";
				$xml.= "</totalMinimosCumplidos>\n";

				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml.= "<totalNoAplicables>";
					$xml.= "$fila_material[na]";
				$xml.= "</totalNoAplicables>\n";
				
				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml .= "<ratio>";
					$xml .= "$fila_material[ratio]";
				$xml .= "</ratio>\n";
				
				$xml .= $tabulador;$xml .= $tabulador;$xml .= $tabulador;
				$xml .= "<observaciones_globales>";
					$xml .= "$fila_material[observaciones_finales]";
				$xml .= "</observaciones_globales>\n";
			
			$xml .= $tabulador;$xml .= $tabulador;
			$xml .= "</resultadoMaterial>\n";
		
		$xml .= $tabulador;
		$xml.= "</evaluacion>\n";

 	$xml.= "</material>\n";
 	
 	$xml = preg_replace("<br>","br/", $xml);

 	$filename .= ".xml";
	
	
 	//if (file_put_contents("objetos2.xml",$xml)){

 	if (file_put_contents($filename ,$xml)){
 		//print '<a href="objetos2.xml">Ver el fichero objetos.xml que acaba de crearse</a> <br>';

 		header("Content-Disposition: atachment; filename=$filename");
 		readfile($filename);

 		unlink($filename);

   }
   else{
         print "El fichero todavia no esta creado";
     }
   
    ?>