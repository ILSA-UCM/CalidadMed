$(document).ready(function(){
	
	$('#idoas').keyup(function(e) {
		var id = $(this).val();
        $.get("oas_buscar.php?id_oas="+id+"", function( data ) {
        	$(".table-responsive").empty();
		  	$(".table-responsive").append(data);
		  
		});
    });

    $('.radio_estado').click(function(e) {
		var estado = $(this).val();
        $.get("oas_buscar.php?estado="+estado+"", function( data ) {
        	$(".table-responsive").empty();
		  	$(".table-responsive").append(data);
		  
		});
    });

    $('#nombre').keyup(function(e) {
		var nombre = $(this).val();
        $.get("oas_buscar.php?nombre="+nombre+"", function( data ) {
        	$(".table-responsive").empty();
		  	$(".table-responsive").append(data);
		  
		});
    });


});