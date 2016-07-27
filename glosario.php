<?php
	require('cabecera.php');
	require ('php/conexion.php');
	$url = "glosario.php";
?>

<!--Esto solo es para cambiar el active del navbar-->
<script type="text/javascript">
	$(".navbar-nav li").each(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        }
    });
	$("#glosario").addClass("active");
</script>

<div class="container">
	<br>	

	<div class="row">
		<div class="col-xs-12 col-md-12 centrarTexto">
			<h1>Glosario</h1>
		</div>
	</div>

	<?php
		//con la siguiente linea me quita el problema de los acentos si se crea el valor desde mysql
		$mysqli->query("SET NAMES 'utf8'");

		$query = "SELECT * FROM glosario";
		$glosario = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
		//numero de registrso me dio la consulta
		$num_total = $glosario->num_rows;
		
		//limito la busqueda
		$TAMANIO_PAGINA = 5;

		//examino la pag. y el inicio del registro a mostrar
		$pagina = $_GET['pagina'];
		if(!$pagina){
			$inicio = 0;
			$pagina = 1;
		}else{
			$inicio = ($pagina -1) * $TAMANIO_PAGINA;
		}
		//calculo del total de paginas
		$total_paginas = ceil($num_total / $TAMANIO_PAGINA);

		//traigo la consulta que varia de acuerdo a cada pagina
		$query1 = "SELECT * FROM glosario ORDER BY termino LIMIT ".$inicio.",".$TAMANIO_PAGINA;
		$listado = $mysqli->query($query1) or die ($mysqli->error. " en la línea ".(__LINE__-1));

		while($registro = $listado->fetch_assoc()){
	?>
		<div class="row justificar">
			<div class="termino"><?php echo $registro['termino']; ?> </div>
			<div ><?php echo $registro['descripcion']; ?></div>
		</div>
		<hr />
	<?php
		}
		$glosario->free();
		$listado->free();
		$mysqli->close();
	?>
	<div class="centrarTexto paginacion">
		<?php
			if ($total_paginas > 1) {
				if ($pagina != 1)
					echo '<a href="'.$url.'?pagina='.($pagina-1).'">&lt;</a>';
				for ($i=1;$i<=$total_paginas;$i++) {
					if ($pagina == $i)
						//si muestro el indice de la pagina actual, no coloco enlace
						echo $pagina;
					else
						//si el indice no corresponde con la pagina mostrada actualmente,
						//coloco el enlace para ir a esa pagina
						echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
				}
				if ($pagina != $total_paginas)
					echo '<a href="'.$url.'?pagina='.($pagina+1).'">&gt;</a>';
			}
		?>
	</div>
	
</div>

<br>

<a href="#" class="scrollup" title="Back to top" > </a>

<?php
	require('pie.php');
?>