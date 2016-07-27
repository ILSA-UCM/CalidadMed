<?php
	require('cabecera.php');
?>
<div class="container">

	<div class="rectangulo_menu">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div class="btn-toolbar" role="toolbar">
					<button type="button" class="rectangulo btn-lg" onclick="parent.location='oas.php'">
						<span class="glyphicon glyphicon-folder-open"></span> Materiales
					</button>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="btn-toolbar" role="toolbar">
					<button type="button" class="rectangulo btn-lg" onclick="parent.location='criterios.php'">
						<span class="glyphicon glyphicon-cog"></span> Configuración
					</button>
				</div>
			</div>

			<div class="col-xs-12 col-md-4">
				<div class="btn-toolbar" role="toolbar">
					<button type="button" class="rectangulo btn-lg" onclick="parent.location='glosario.php?pagina=1'">
						<span class="glyphicon glyphicon-search"></span> Glosario
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<br>
<?php
	require('pie.php');
?>