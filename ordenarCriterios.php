<?php
	require('cabecera.php');
	require ('php/conexion.php');
?>

<!--Esto solo es para cambiar el active del navbar-->
<script type="text/javascript">
	$(".navbar-nav li").each(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        }
    });
	$("#configuracion").addClass("active");
</script>

<div class="container">
	<br>	
	<div class="row">
		<div class="col-xs-12 col-md-12 centrarTexto">
			<h2>Ordenar Criterios</h2>
			<!--<h3>Arrastre y coloque el criterio en el lugar que le gustaría que saliera</h3>-->
		</div>
	</div>
	<div class="row">
		<div class="dd" id="nestable3">
			<ol class="dd-list">
			<?php
				$query_criterios = "SELECT id, titular_es FROM criterios ORDER BY orden";
				$lista_criterios = $mysqli->query($query_criterios) or die ($mysqli->error. " en la línea ".(__LINE__-1));
				$num_filas = $lista_criterios->num_rows;
				if($num_filas == 0){
					echo "<h4> Aún no hay criterios para ordenar,  ir a configuración y añadir criterios.</h4>";
				}
				while($registro = $lista_criterios->fetch_assoc()){
			?>
		            <li class="dd-item dd3-item" data-id="<?php echo $registro['id']; ?>">
		                <div class="dd-handle dd3-handle">Drag</div>
		                <div class="dd3-content justificar"> <?php echo $registro['titular_es']; ?>
			                <span class="glyphicon glyphicon-cog right ordItemsC" onclick="parent.location='ordenarItems.php?id=<?php echo $registro['id'];?>'" data-toggle="Configuracion" title="Ordenar items del Criterio"></span>
		            	</div>
		            </li>
		        <?php
			    	}
			    	$lista_criterios->free();
					$mysqli->close();
		    	?>
	        </ol>
    	</div>
	</div>
</div>
<br>

<!-- Control de los criterios a ordenar-->
<script>
$(document).ready(function()
{
    var updateCriterios = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('outputC');
        if (window.JSON) {
            var ordenCriterios = list.nestable('serialize');
            console.log(ordenCriterios);
            var jObject = {};
            for (var i=0; i < ordenCriterios.length; i++){
            	jObject[i] = ordenCriterios[i]['id'];
            }
            jObject= JSON.stringify(jObject);
    		
    		//mando a ordenar en la BD
    		$.ajax({
	            type:'post',
	            cache:false,
	            url:"php/ordenarCriteriosBD.php",
	            data:{jObject:  jObject},
	            success:function(server){
	            	
	            }
		    });
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    $('#nestable3').nestable({
        group: 1
    })
    .on('change', updateCriterios);

    $('#nestable3').data('outputC');

});

</script>


<?php
	require('pie.php');
?>