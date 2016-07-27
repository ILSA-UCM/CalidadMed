<?php
	require('cabecera.php');
	require ('php/conexion.php');
	$id = $_GET['id'];
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
			<h2>Ordenar Items del Criterio</h2>
			<!--<h3>Arrastre y coloque el criterio en el lugar que le gustaría que saliera</h3>-->
		</div>
	</div>
	<div class="row">
		<div class="dd" id="nestable4">
			<ol class="dd-list">
			<?php
				$query_items = "SELECT id, item_es FROM items WHERE id_criterio=$id ORDER BY orden";
				$lista_items = $mysqli->query($query_items) or die ($mysqli->error. " en la línea ".(__LINE__-1));
				$num_filas = $lista_items->num_rows;
				if($num_filas == 0){
					echo "<h4> El criterio seleccionado no tiene items para ordenar, puede ir a configuración y añadir items al criterio.</h4>";
				}
				while($registro = $lista_items->fetch_assoc()){
			?>
		            <li class="dd-item dd3-item" data-id="<?php echo $registro['id']; ?>">
		                <div class="dd-handle dd3-handle">Drag</div>
		                <div class="dd3-content justificar"> <?php echo $registro['item_es']; ?>
		            	</div>
		            </li>
		        <?php
			    	}
			    	$lista_items->free();
					$mysqli->close();
		    	?>
	        </ol>
    	</div>
	</div>
</div>

<br>

<script>
$(document).ready(function()
{
    var updateItems = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('outputI');
        if (window.JSON) {
            var ordenItems = list.nestable('serialize');
            console.log(ordenItems);
            var jObject = {};
            for (var i=0; i < ordenItems.length; i++){
            	jObject[i] = ordenItems[i]['id']; 
            	//console.log(ordenCriterios[i]['id']);
            }
            jObject= JSON.stringify(jObject);
    		
    		//mando a ordenar en la BD
    		$.ajax({
	            type:'post',
	            cache:false,
	            url:"php/ordenarItemsBD.php",
	            data:{jObject:  jObject},
	            success:function(server){
	            	console.log(server);//cuando reciva la respuesta lo imprimo, se puede quitar
	            }
		    });
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    $('#nestable4').nestable({
        group: 1
    })
    .on('change', updateItems);

    $('#nestable4').data('outputI');

});

</script>

<?php
	require('pie.php');
?>