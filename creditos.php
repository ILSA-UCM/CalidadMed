<?php
	require('cabecera.php');
?>

<script type="text/javascript">
	$(".navbar-nav li").each(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        }
    });
	$("#creditos").addClass("active");
</script>

<div class="container">
	<br>	

	<div class="row">
		<div class="col-xs-12 col-md-12 centrarTexto">
			<h1>Créditos</h1>
		</div>
	</div>


	<div class="row">
		<br>
		<div class="col-xs-12 col-md-12 centrarTexto lead">
			Herramienta creada por Andrea Rueda y Chaymae Riani <br>
			Para el Trabajo de Fin de Grado <br>
			de la Facultad de Informática <br>
			Universidad Complutense de Madrid. <br> 
			Convocatoria 2016 <br>
			Dirección: A. Sarasa Cabezuelo y A. Fernández-Pampillón Cesteros <br> <br>
		</div>
	</div>

</div>


<?php
	require('pie.php');
?>