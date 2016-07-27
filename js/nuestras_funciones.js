/*Nuestro .js*/

	
//VARIABLES GLOBALES
//numero de items de cada tipo
var m=0;//minimos
var e=0;//excelentes
var na=0;//no aplicables

var total=0;//suma total
var num_items=0; //a lo mejor lo traemos directamente de bd...

function resetActive(event, step) {

    $("div").each(function () {
        if ($(this).hasClass("activestep")) {
            $(this).removeClass("activestep");
        }
    });

    if (event.target.className == "col-md-2") {
        $(event.target).addClass("activestep");
    }
    else {
        $(event.target.parentNode).addClass("activestep");
    }

    hideSteps();
    showCurrentStepInfo(step);
}


function hideSteps() {
    $("div").each(function () {
        if ($(this).hasClass("activeStepInfo")) {
            $(this).removeClass("activeStepInfo");
            $(this).addClass("hiddenStepInfo");
        }
    });
}

function showCurrentStepInfo(step) {
    var id = "#" + step;
    $(id).addClass("activeStepInfo");
}


function mostrarInformacion(item){
	var classe = "."+item;
	$(classe).css("display", "block");
	$("span."+item).css("display", "none");
}

function ocultarInformacion(item){
	var classe = "."+item;
	$(classe).css("display", "none");
	$("span."+item).css("display", "inline");
}


/*Para mostrar informacion de los iconos, para que sirven si no estan acostumbrados a verlos*/
$('[data-toggle="GuardarBorrador"]').tooltip();
$('[data-toggle="Evaluar"]').tooltip();
$('[data-toggle="Descargar"]').tooltip();
$('[data-toggle="EjecutarEvaluacion"]').tooltip();
$('[data-toggle="Eliminar"]').tooltip();
$('[data-toggle="Editar"]').tooltip();
$('[data-toggle="Configuracion"]').tooltip();

/*scroll top*/
 $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
});

$('.scrollup').click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});

//para limpiar el modal del formulario de annadir un OAs
$(".cancelarAnnadirOAs").click(function(){
	$("#nombreOAs").val("");
	$("#descripcionOAs").val("");
});


//para eliminar un OAs (importante que se asocie mediante el .on [dimanicos])
$("#tabla-oas").on("click", ".eoa", function(e){//tengo el boton de eliminar del que se ha sido echo click

	//tomo el valor del identificador del OAs
	e.preventDefault();

	var id = $(this).attr('id');
	eliminarOAs(id);
});

//para eliminar un OAs (importante que se asocie mediante el .on [dimanicos])
$("#tabla-criterios").on("click", ".ecriterio", function(e){//tengo el boton de eliminar del que se ha sido echo click
	e.preventDefault();

	var id = $(this).attr('id');
	eliminarCriterio(id);
	console.log("eliminar criterio:"+id);
});

$(".infoCriterio").on("click",".editar",function(e){
	var id = $(".infoCriterio").attr("data-id");
	mostrarInformacionCriterioModal(id);
	console.log("mostrando información del criterio:"+id+" En el modal");
});

//para limpiar el modal del formulario de annadir un criterio
$(".cancelarAnnadirCriterio").click(function(){
	$("#nombreCriterio").val("");
	$("#descripcionCriterio").val("");
});

//para limpiar el modal del formulario de annadir un Items
$(".cancelarAnnadirItems").click(function(){
	$("#nombreItems").val("");
	$("#descripcionItems").val("");
	$("#modalAnnadirItems").find("select.nivelItems").val("M");
});

//Items para editar
$("#tabla-items").on("click",".editarItem",function(e){
	var id = $(this).attr('data-id');
	objetop = $(this).parents('tr');
	mostrarInformacionItemModal(id);
	console.log("mostrando información del item:"+id+" En el modal");
});

$("#modalEditarInfoItem").on("click",".cancelarAnnadirItems", function(e){
	if($(".campoObligatorioNombreItems").hasClass("has-error")) {
		$(".campoObligatorioNombreItems").removeClass("has-error");
		$("#nombreItemsE").removeAttr("placeholder");
  	}

	if($(".campoObligatorioDescripcionItems").hasClass("has-error")) {
		$(".campoObligatorioDescripcionItems").removeClass("has-error");
		$("#descripcionItemsE").removeAttr("placeholder");
  	}
});

$("#tabla-items").on("click", ".eliminarItems", function(e){
	console.log("Eliminar el item");
	console.log($(this).attr("id"));
	var id_criterio = $(this).closest('#tabla-items').attr("data-criterio");
	console.log("criterio: "+ id_criterio);
	eliminarItem($(this).attr("id"), id_criterio);
});

//setInterval('actualizarBarEstado()',3000);

$(".rangominimo").on("change",function(e){
	var minimo = parseInt($(".rangominimo").val() ) + 1;
	$(".rangomaximo").attr("min", minimo);
});

//=====================evaluacion==============================================================
$('.barStado .evaluar').on("click",function(){
	var id = $('.the_id_of_this_evluacion').val();

	$.get("guardar_xml.php?id="+id, function( data ) {
		//alert(' Se ha finalizado la evaluacion !');
	});

	$.get("changetoevaluado.php?id="+id, function( data ) {
			parent.location = 'oas.php';	
	});

});

$('.barStado .guardar').on("click",function(){
	parent.location = 'oas.php';
});

$(document).ready(function() {

function saveTableItems(dataOa,dataCriterio){
	var TableData = new Array();
	var select;
	var this_table_tr = $('.evaluacion_criterio[data-oa='+dataOa+'][data-criterio='+dataCriterio+'] tr');

	$.each(this_table_tr,function(row, tr){
		if ($(tr).find('td:eq(4) input').is(':checked')) {
			select = 1;
		}else{
			select = 0;
		}
		var id_item = parseInt($(tr).find('td:eq(0) input').val());
		var pun = parseInt($(tr).find('td:eq(3) select').val());
	    TableData[row]={
	    	"id_item" : id_item
	        ,"puntuacion" : pun
	        , "no_applicable" : select
	        , "observaciones" : $(tr).find('td:eq(5) textarea').val()
	    }
	});
	TableData.shift()
	return TableData;
}

function sendDataTable(dataOa,dataCriterio){
	var TableItems;
	TableItems = saveTableItems(dataOa,dataCriterio);
	var data = $.toJSON(TableItems);
	//alert(dataOa+' '+dataCriterio);
	$.ajax({
	    type: "POST",
	    url: "salvaritems.php?id_oa="+dataOa+"&id_criterio="+dataCriterio,
	    data: "itemsata=" + data,
	    success: function(msg){
	        // return value stored in msg variable
	    }
	});
}

//donde se guarda la evaluacion de los items de cada criterio (boton)
$('.save_this_criterio').on('click',function() {
	var id_criterio = $(this).attr('data-criterio');
	var id_oa = $(this).attr('data-oa');
	saveResultadoFinale($(this));
	sendDataTable(id_oa,id_criterio);

	$.get("itemsevaluados.php?id_oa="+id_oa+"", function( data ) {
		$('.SubTotalCriterio').find('.itemsevaluados_td').empty().append(data);
	});
	var id = id_criterio;
	var minimos = $('.activeStepInfo').find('.minimos_'+id).val(); 
	var total = $('.activeStepInfo').find('.total_'+id).val(); 
	var na = $('.activeStepInfo').find('.na_'+id).val(); 	

	$.get("resultado.php?id_criterio="+id_criterio+"&id_oa="+id_oa+"&minimos="+minimos+"&total="+total+"&no_aplicables="+na+"", function( data ) {
		$('.setup-resultado').empty().append(data);
		actualizarBarEstado();
	});
});

});

$('.puntuacion').on('focusin', function(){
    $(this).data('val', $(this).val());
});


$('.puntuacion').on("change",function(){
	var thi = parseInt($(this).val());
	
	var prev = $(this).data('val');

	var item = $(this).attr('data-item');
	var this_evaluacion = $(".class_item[data-item="+item+"]");
	var criterio = $(this).attr('data-criterio');
	var puntuacion = this_evaluacion.find('.puntuacion').val();

	var id = criterio;
	var total = $('.activeStepInfo').find('.total_'+id).val();
	total -= parseInt(prev);
	total += parseInt(puntuacion);
	$('.activeStepInfo').find('.SingleTotalCriterio').find('.total_pun').val(total);
	//para que se actualice correctamente el total de cada criterio
	$(this).data('val', puntuacion);

});

function saveResultadoFinale(elment){

	var objeto = $('.evaluacion_criterio').attr('data-oa');
	var item = elment.attr('data-criterio');
	var id_criterio = elment.attr('data-criterio');
	var crit_itemsnum = elment.attr('data-numItem');
	var itemsnum = $('.SubTotalCriterio').find('.itemsnum').val(); 
	var minimos = $('.SubTotalCriterio').find('.minimos').val(); 
	var aplicable = $('.SubTotalCriterio').find('.aplicable').val(); 
	var na = $('.SubTotalCriterio').find('.na').val(); 
	var total = $('.SubTotalCriterio').find('.total').val();
	var ratio = $('.SubTotalCriterio').find('.ratio').val(); 
	var observaciones_finales = $('.SubTotalCriterio').find('.observaciones_finales').val(); 
	var itemsevaluados = $('.SubTotalCriterio').find('.itemsevaluados').val(); 
	
	var queryString = "?itemsnum="+itemsnum;
	queryString += "&id_oa="+objeto;
	queryString += "&id_criterio="+id_criterio;
	queryString += "&id_item="+item;
	queryString += "&crit_itemsnum="+crit_itemsnum;
	queryString += "&minimos="+minimos;
	queryString += "&aplicable="+aplicable;
	queryString += "&na="+na;
	queryString += "&total="+total;

	queryString += "&ratio="+ratio;
	queryString += "&observaciones_finales="+observaciones_finales;
	queryString += "&itemsevaluados="+itemsevaluados;

	$.get("resultado-finale.php"+queryString+"", function( data ) {

	});
};

function saveResultadoFinaleObs(){
	var objeto = $('.evaluacion_criterio').attr('data-oa');
	var itemsnum = $('.SubTotalCriterio').find('.itemsnum').val(); 
	var minimos = $('.SubTotalCriterio').find('.minimos').val(); 
	var aplicable = $('.SubTotalCriterio').find('.aplicable').val(); 
	var na = $('.SubTotalCriterio').find('.na').val(); 
	var total = $('.SubTotalCriterio').find('.total').val();
	var ratio = $('.SubTotalCriterio').find('.ratio').val(); 

	var observaciones_finales = $('.SubTotalCriterio').find('.observaciones_finales').val(); 
	var itemsevaluados = $('.SubTotalCriterio').find('.itemsevaluados').val(); 

	var queryString = "?itemsnum="+itemsnum;
	queryString += "&id_oa="+objeto;
	queryString += "&minimos="+minimos;
	queryString += "&aplicable="+aplicable;
	queryString += "&na="+na;
	queryString += "&total="+total;
	queryString += "&ratio="+ratio;
	queryString += "&observaciones_finales="+observaciones_finales;
	queryString += "&itemsevaluados="+itemsevaluados;

	$.get("resultado-finale-obs.php"+queryString+"", function( data ) {

	});
};

$('.no_applicable_select').on('click',function() {
	var id_item = $(this).attr('data-item');
	var this_obs = $(".observaciones[data-item="+id_item+"]");
	var obs = $.trim(this_obs.val());
	if	 (obs.length == 0) {
		$(this).prop('checked', false);
		this_obs.css({
			border: '1px solid red',
			background: '#fff'
		});
		alert('Las observaciones son obligatorias !!');
	}
});

$(".observaciones").on("change",function(){
	var id_item = $(this).attr('data-item');
	var this_obs = $(".observaciones[data-item="+id_item+"]");
	var this_selct = $(".no_applicable_select[data-item="+id_item+"]");
	var obs = $.trim(this_obs.val());
	var id_oa = $(this).attr('data-oa');
	var this_elm =$(this);

    this_obs.css({
			border: '1px solid #ccc',
			background: '#fff'
	});
	if(obs.length == 0) {
		this_selct.prop('checked', false);
	}
});


$(".setup-resultado").on("click", ".save_finales", function(e){
	saveResultadoFinaleObs();
});

$('.no_applicable_select').on('click',function() {

	var id_item = $(this).attr('data-item');
	var id_oa = $(this).attr('data-oa');
	var this_pun = $(".puntuacion[data-item="+id_item+"]");
	var this_obs = $(".observaciones[data-item="+id_item+"]");	
	var obs = $.trim(this_obs.val());
	if (($(this).is(':checked')) && (obs.length != 0)) {
		this_pun.prop('disabled', true);

		//cambio el total
		var restarTotal = $('.activeStepInfo').find('.SingleTotalCriterio').find('.total_pun').val();
		restarTotal -= parseInt(this_pun.val());
		$('.activeStepInfo').find('.SingleTotalCriterio').find('.total_pun').val(restarTotal);
		//vuelve el valor a cero
		this_pun.val('0');
	}else if(!$(this).is(':checked')){
		this_pun.removeAttr('disabled');
		var this_elm =$(this);
	}

});

$('.no_applicable_select').on('click',function() {
	var na_iput = $('.activeStepInfo').find('.total_na').val();
	var total = $('.activeStepInfo').find('.SingleTotalCriterio').find('.total_na');
	var na = parseInt(na_iput);
	if (($(this).is(':checked'))) {
		total.val(na+1);
	}else if(!$(this).is(':checked') && (total.val()!=0)){
		total.val(na-1);
	}
});

//se carga este valor por primera vez de alli ya no se vuelve a llamar
$(window).ready(function($) {
	saveResultadoFinaleObs();
});
