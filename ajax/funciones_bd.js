function annadirOAs(){

   //la función .trim(cad) me quita todos los espacios en blanco de inicio y final de una cadena 
   var nombreOAs = $.trim($("#nombreOAs").val());


   //verificar campo nombre no este vacio
   if(nombreOAs.length < 1){
      $("#nombreOAs").val("");
      $("#campoObligatorioAnnadirOA").addClass("has-error");
      $("#nombreOAs").attr("placeholder","Por favor introduzca un titulo para el Material");
      return false;
   }
   else{//miro si tiene la clase por algun error anterior para quitarlos
      if($("#campoObligatorioAnnadirOA").hasClass("has-error")) {
         $("#campoObligatorioAnnadirOA").removeClass("has-error");
         $("#nombreOAs").removeAttr("placeholder");
      }
   }

	//variable para el ajax
	var ajaxRequest;

	try {
      	//Opera 8.0+, Firefox, Safari
    	ajaxRequest = new XMLHttpRequest();
   	}catch (e) {
      	//Internet Explorer Browsers
      	try {
        	   ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      	}catch (e) {
         	try{
            	ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         	}catch (e){
            	// Something went wrong
            	alert("Your browser broke!");
            	return false;
         	}
      	}
   	}

   	//esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   	ajaxRequest.onreadystatechange = function(){
   		if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
   			//$("#tabla-oas").prepend("Lo que quiero poner primero");
   			var ajaxDisplay = document.getElementById('tabla-oas');
            $("#tabla-oas").append(ajaxRequest.responseText);
            //Al hacer click no se oculta asi que pongo este aqui y se oculta y limpio los campos
            $("#nombreOAs").val("");
            $("#descripcionOAs").val("");
            $("#modalAnnadirOAs").modal("hide");
            //$("#")
   		}
   	}

   	//tomamos los valores del usuario para pasarlos al servidor
   	nombreOAs = document.getElementById('nombreOAs').value;
   	var descripcionOAs = document.getElementById('descripcionOAs').value;

   	//los valores de forma par1=valor1&par2=valor2
   	var queryString = "?nombre="+nombreOAs;
   	queryString += "&descripcion="+descripcionOAs;
   	ajaxRequest.open("GET","php/annadirOAs.php"+queryString,true);
   	ajaxRequest.send();
}

function eliminarOAs(oa){

   var id_oa = oa;

   var ajaxRequest;

   try {
      //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e) {
      //Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         //despues .append("texto");
         //puedo iterar por toda la tabla $('#tabla-oas').find("tbody").each(function () { }
         //donde voy a escribir los datos, machaca todos los datos del cuerpo de la tabla
         $('#tabla-oas').html(ajaxRequest.responseText);
         //document.getElementById('tabla-oas').innerHTML = ajaxRequest.responseText;
      }
   }

   //tomamos los valores del usuario para pasarlos al servidor

   //los valores de forma par1=valor1&par2=valor2
   var queryString = "?id_oa="+id_oa;
   ajaxRequest.open("GET","php/eliminarOAs.php"+queryString,true);
   ajaxRequest.send();

}

function annadirCriterio(){
   //la función .trim(cad) me quita todos los espacios en blanco de inicio y final de una cadena 
   var nombreCriterio = $.trim($("#nombreCriterio").val());
   var descripcionCriterio =$.trim($("#descripcionCriterio").val());


   //verificar campo nombre no este vacio
   if((nombreCriterio.length < 1) && (descripcionCriterio.length < 1)){
      $("#nombreCriterio").val("");
      $("#campoObligatorioNombreCriterio").addClass("has-error");
      $("#nombreCriterio").attr("placeholder","Por favor introduzca un nombre del criterio");

      $("#descripcionCriterio").val("");
      $("#campoObligatorioDescripcionCriterio").addClass("has-error");
      $("#descripcionCriterio").attr("placeholder","Por favor introduzca una descripción del criterio");

      return false;
   }else if(nombreCriterio.length < 1){
      $("#nombreCriterio").val("");
      $("#campoObligatorioNombreCriterio").addClass("has-error");
      $("#nombreCriterio").attr("placeholder","Por favor introduzca un nombre del criterio");
      return false;
   }else if(descripcionCriterio.length < 1){
      $("#descripcionCriterio").val("");
      $("#campoObligatorioDescripcionCriterio").addClass("has-error");
      $("#descripcionCriterio").attr("placeholder","Por favor introduzca una descripción del criterio");
      return false;
   }
   else{//miro si tiene la clase por algun error anterior para quitarlos
      if($("#campoObligatorioNombreCriterio").hasClass("has-error")) {
         $("#campoObligatorioNombreCriterio").removeClass("has-error");
         $("#nombreCriterio").removeAttr("placeholder");
      }

      if($("#campoObligatorioDescripcionCriterio").hasClass("has-error")) {
         $("#campoObligatorioDescripcionCriterio").removeClass("has-error");
         $("#descripcionCriterio").removeAttr("placeholder");
      }
   }

   //variable para el ajax
   var ajaxRequest;

   try {
         //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
      }catch (e) {
         //Internet Explorer Browsers
         try {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
         }catch (e) {
            try{
               ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }catch (e){
               // Something went wrong
               alert("Your browser broke!");
               return false;
            }
         }
      }

      //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
      ajaxRequest.onreadystatechange = function(){
         if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
            //$("#tabla-oas").prepend("Lo que quiero poner primero");
            //var ajaxDisplay = document.getElementById('tabla-criterios');
            $("#tabla-criterios").append(ajaxRequest.responseText);
            //Al hacer click no se oculta asi que pongo este aqui y se oculta y limpio los campos
            $("#nombreCriterio").val("");
            $("#descripcionCriterio").val("");
            $("#modalAnnadirCriterio").modal("hide");
            //$("#")
         }
      }

      //los valores de forma par1=valor1&par2=valor2
      var queryString = "?nombre="+nombreCriterio;
      queryString += "&descripcion="+descripcionCriterio;
      ajaxRequest.open("GET","php/annadirCriterios.php"+queryString,true);
      ajaxRequest.send();
}

function eliminarCriterio(criterio){
   console.log(criterio);

   var id_criterio = criterio;

   var ajaxRequest;

   try {
      //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e) {
      //Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         $('#tabla-criterios').html(ajaxRequest.responseText);  
      }
   }

   //tomamos los valores del usuario para pasarlos al servidor

   //los valores de forma par1=valor1&par2=valor2
   var queryString = "?id_criterio="+id_criterio;
   ajaxRequest.open("GET","php/eliminarCriterio.php"+queryString,true);
   ajaxRequest.send();

}

//es el editar de cada criterio de la tabla de criterios muestra todos los items del criterio
function editarCriterio(criterio){
   console.log(criterio);

   var id_criterio = criterio;

   var ajaxRequest;

   try {
      //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e) {
      //Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         $('#tabla-items').html(ajaxRequest.responseText);  
      }
   }

   //tomamos los valores del usuario para pasarlos al servidor

   //los valores de forma par1=valor1&par2=valor2
   var queryString = "?id_criterio="+id_criterio;
   ajaxRequest.open("GET","php/mostrarItems.php"+queryString,true);
   ajaxRequest.send();
}

function actualizarCriterio(criterio){
   var nombreCriterio = $.trim($("#nombreCriterio").val());
   var descripcionCriterio =$.trim($("#descripcionCriterio").val());


   //verificar campo nombre no este vacio
   if((nombreCriterio.length < 1) && (descripcionCriterio.length < 1)){
      $("#nombreCriterio").val("");
      $("#campoObligatorioNombreCriterio").addClass("has-error");
      $("#nombreCriterio").attr("placeholder","Por favor introduzca un nombre del criterio");

      $("#descripcionCriterio").val("");
      $("#campoObligatorioDescripcionCriterio").addClass("has-error");
      $("#descripcionCriterio").attr("placeholder","Por favor introduzca una descripción del criterio");

      return false;
   }else if(nombreCriterio.length < 1){
      $("#nombreCriterio").val("");
      $("#campoObligatorioNombreCriterio").addClass("has-error");
      $("#nombreCriterio").attr("placeholder","Por favor introduzca un nombre del criterio");
      return false;
   }else if(descripcionCriterio.length < 1){
      $("#descripcionCriterio").val("");
      $("#campoObligatorioDescripcionCriterio").addClass("has-error");
      $("#descripcionCriterio").attr("placeholder","Por favor introduzca una descripción del criterio");
      return false;
   }
   else{//miro si tiene la clase por algun error anterior para quitarlos
      if($("#campoObligatorioNombreCriterio").hasClass("has-error")) {
         $("#campoObligatorioNombreCriterio").removeClass("has-error");
         $("#nombreCriterio").removeAttr("placeholder");
      }

      if($("#campoObligatorioDescripcionCriterio").hasClass("has-error")) {
         $("#campoObligatorioDescripcionCriterio").removeClass("has-error");
         $("#descripcionCriterio").removeAttr("placeholder");
      }
   }

   //variable para el ajax
   var ajaxRequest;

   try {
         //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
      }catch (e) {
         //Internet Explorer Browsers
         try {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
         }catch (e) {
            try{
               ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }catch (e){
               // Something went wrong
               alert("Your browser broke!");
               return false;
            }
         }
      }

      //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
      ajaxRequest.onreadystatechange = function(){
         if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
            $(".infoCriterio").html(ajaxRequest.responseText);
            //Al hacer click no se oculta asi que pongo este aqui y se oculta y limpio los campos
            $("#nombreCriterio").val("");
            $("#descripcionCriterio").val("");
            $("#modalEditarInfoCriterio").modal("hide");
         }
      }

      //los valores de forma par1=valor1&par2=valor2
      var queryString = "?nombre="+nombreCriterio;
      queryString += "&descripcion="+descripcionCriterio;
      queryString += "&id="+criterio;
      ajaxRequest.open("GET","php/actualizarCriterio.php"+queryString,true);
      ajaxRequest.send();
}

/*se muestra en la cab de la Pag. de Items*/
function mostrarInformacionCriterio(criterio){

   var id_criterio = criterio;

   var m = 0;//entonces cabecera
   if(modal==1){
      m=1;//pintar modal
   }

   var ajaxRequest;
   try {
      //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e) {
      //Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         if(modal==0){//pintar en la cabecera
            //annado atributo
            //$('.infoCriterio').attr("data-id",id_criterio);
            $('.infoCriterio').html(ajaxRequest.responseText);  
         }
      }else{
         alert("No me devuelve 4 sino 2");
      }
   }

   //tomamos los valores del usuario para pasarlos al servidor

   //los valores de forma par1=valor1&par2=valor2
   var queryString = "?id_criterio="+id_criterio;
   queryString += "&modal=" + m;
   //alert("php/mostrarInformacionCriterio.php"+queryString);
   ajaxRequest.open("GET","php/mostrarInformacionCriterio.php"+queryString,true);

   //ajaxRequest.open("GET","php/eliminarCriterio.php"+queryString,true);
   ajaxRequest.send();
}

function mostrarInformacionCriterioModal(criterio){

   var id_criterio = criterio;

   var ajaxRequest;
   try {
      //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e) {
      //Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
            $("#modalEditarInfoCriterio .modal-content").html(ajaxRequest.responseText);
            $("#modalEditarInfoCriterio").modal();
      }/*else{
         //alert("No me devuelve 4 sino 2");
         console.log(ajaxRequest);
      }*/
   }

   //los valores de forma par1=valor1&par2=valor2
   var queryString = "?id_criterio="+id_criterio;
   //alert("php/mostrarInformacionCriterioModal.php"+queryString);
   ajaxRequest.open("GET","php/mostrarInformacionCriterioModal.php"+queryString,true);
   ajaxRequest.send();
}

function annadirItems(){
   //la función .trim(cad) me quita todos los espacios en blanco de inicio y final de una cadena 
   var nombreItems = $.trim($("#nombreItems").val());
   var descripcionItems =$.trim($("#descripcionItems").val());


   //verificar campo nombre no este vacio
   if((nombreItems.length < 1) && (descripcionItems.length < 1)){
      $("#nombreItems").val("");
      $(".campoObligatorioNombreItems").addClass("has-error");
      $("#nombreItems").attr("placeholder","Por favor introduzca un nombre del items");

      $("#descripcionItems").val("");
      $(".campoObligatorioDescripcionItems").addClass("has-error");
      $("#descripcionItems").attr("placeholder","Por favor introduzca una descripción del Items");

      return false;
   }else if(nombreItems.length < 1){
      $("#nombreItems").val("");
      $(".campoObligatorioNombreItems").addClass("has-error");
      $("#nombreItems").attr("placeholder","Por favor introduzca un nombre del items");
      return false;
   }else if(descripcionItems.length < 1){
      $("#descripcionItems").val("");
      $(".campoObligatorioDescripcionItems").addClass("has-error");
      $("#descripcionItems").attr("placeholder","Por favor introduzca una descripción del Items");
      return false;
   }
   else{//miro si tiene la clase por algun error anterior para quitarlos
      if($(".campoObligatorioNombreItems").hasClass("has-error")) {
         $(".campoObligatorioNombreItems").removeClass("has-error");
         $("#nombreItems").removeAttr("placeholder");
      }

      if($(".campoObligatorioDescripcionItems").hasClass("has-error")) {
         $(".campoObligatorioDescripcionItems").removeClass("has-error");
         $(".descripcionItems").removeAttr("placeholder");
      }
   }

   //variable para el ajax
   var ajaxRequest;

   try {
         //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
      }catch (e) {
         //Internet Explorer Browsers
         try {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
         }catch (e) {
            try{
               ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }catch (e){
               // Something went wrong
               alert("Your browser broke!");
               return false;
            }
         }
      }

      //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
      ajaxRequest.onreadystatechange = function(){
         if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
            //$("#tabla-oas").prepend("Lo que quiero poner primero");
            //var ajaxDisplay = document.getElementById('tabla-criterios');
            $("#tabla-items").append(ajaxRequest.responseText);
            //Al hacer click no se oculta asi que pongo este aqui y se oculta y limpio los campos
            $("#nombreItems").val("");
            $("#descripcionItems").val("");
            $("#modalAnnadirItems").modal("hide");
            $("#modalAnnadirItems").find("select.nivelItems").val("M");
            //$("#")
         }
      }

      var criterio = $("#annadirItems").attr("data-criterio");
      var nivel = $("#modalAnnadirItems").find("select.nivelItems").val();
      //los valores de forma par1=valor1&par2=valor2
      var queryString = "?nombre="+nombreItems;
      queryString += "&descripcion="+descripcionItems;
      queryString += "&id_criterio="+criterio;
      queryString += "&nivel="+nivel;
      ajaxRequest.open("GET","php/annadirItems.php"+queryString,true);
      ajaxRequest.send();   
}

function actualizarEvaluacion(criterio,item,objeto,nivel,observacion,puntuacion){

   var ajaxRequest;

   try {
      //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e) {
      //Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         console.log("Se ha actualizado correctamente"); 
      }
   }

   //tomamos los valores del usuario para pasarlos al servidor

   //los valores de forma par1=valor1&par2=valor2
   var queryString = "?id_criterio="+criterio;
   queryString += "&id_item="+item;
   queryString += "&id_oa="+objeto;
   queryString += "&nivel="+nivel;
   queryString += "&puntuacion="+puntuacion;
   queryString += "&observacion="+observacion;
   console.log(queryString);
   ajaxRequest.open("GET","php/actualizarEvaluacion.php"+queryString,true);
   ajaxRequest.send();
}


/************************************************************/
function mostrarInformacionItemModal(item){

   var id_item = item;

   var ajaxRequest;
   try {
      //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e) {
      //Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         $("#modalEditarInfoItem .modal-content").html(ajaxRequest.responseText);
         $("#modalEditarInfoItem").modal();
      }
   }

   //los valores de forma par1=valor1&par2=valor2
   var queryString = "?id_item="+id_item;
   //alert("php/mostrarInformacionCriterioModal.php"+queryString);
   ajaxRequest.open("GET","php/mostrarInformacionItemModal.php"+queryString,true);
   ajaxRequest.send();
}

function actualizarItem(item){
   
      //la función .trim(cad) me quita todos los espacios en blanco de inicio y final de una cadena 
   var nombreItems = $.trim($("#nombreItemsE").val());
   var descripcionItems =$.trim($("#descripcionItemsE").val());

   //verificar campo nombre no este vacio
   if((nombreItems.length < 1) && (descripcionItems.length < 1)){
      $("#nombreItemsE").val("");
      $(".campoObligatorioNombreItems").addClass("has-error");
      $("#nombreItemsE").attr("placeholder","Por favor introduzca un nombre del items");

      $("#descripcionItemsE").val("");
      $(".campoObligatorioDescripcionItems").addClass("has-error");
      $("#descripcionItemsE").attr("placeholder","Por favor introduzca una descripción del Items");

      return false;
   }else if(nombreItems.length < 1){
      $("#nombreItemsE").val("");
      $(".campoObligatorioNombreItems").addClass("has-error");
      $("#nombreItemsE").attr("placeholder","Por favor introduzca un nombre del items");
      return false;
   }else if(descripcionItems.length < 1){
      $("#descripcionItemsE").val("");
      $(".campoObligatorioDescripcionItems").addClass("has-error");
      $("#descripcionItemsE").attr("placeholder","Por favor introduzca una descripción del Items");
      return false;
   }
   else{//miro si tiene la clase por algun error anterior para quitarlos
      if($(".campoObligatorioNombreItems").hasClass("has-error")) {
         $(".campoObligatorioNombreItems").removeClass("has-error");
         $("#nombreItemsE").removeAttr("placeholder");
      }

      if($(".campoObligatorioDescripcionItems").hasClass("has-error")) {
         $(".campoObligatorioDescripcionItems").removeClass("has-error");
         $("#descripcionItemsE").removeAttr("placeholder");
      }
   }

   //variable para el ajax
   var ajaxRequest;

   try {
         //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
      }catch (e) {
         //Internet Explorer Browsers
         try {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
         }catch (e) {
            try{
               ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }catch (e){
               // Something went wrong
               alert("Your browser broke!");
               return false;
            }
         }
      }



      //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
      ajaxRequest.onreadystatechange = function(){
         if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
            //var buscar = "[data-id = " + item + " ]";
            //$("#tabla-items").find(buscar).parents('tbody').ht...
            $("#tabla-items").html(ajaxRequest.responseText);
            $("#nombreItemsE").val("");
            $("#descripcionItemsE").val("");
            $("#modalEditarInfoItem").modal("hide");
         }
      }

      var queryString = "?nombre="+nombreItems;
      queryString += "&descripcion="+descripcionItems;
      queryString += "&id_item="+item;
      queryString += "&id_criterio="+ $("#tabla-items").attr("data-criterio");
      queryString += "&nivel=" + $("#modalEditarInfoItem").find("select.nivelItemsE").val();
      ajaxRequest.open("GET","php/actualizarItems.php"+queryString,true);
      ajaxRequest.send();   
}


function eliminarItem(item, criterio){
   var ajaxRequest;

   try {
      //Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e) {
      //Internet Explorer Browsers
      try {
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         $('#tabla-items').html(ajaxRequest.responseText);
      }
   }

   //tomamos los valores del usuario para pasarlos al servidor

   //los valores de forma par1=valor1&par2=valor2
   var queryString = "?id_item="+item;
   queryString += "&id_criterio="+criterio;
   ajaxRequest.open("GET","php/eliminarItem.php"+queryString,true);
   ajaxRequest.send();

}

function actualizarBarEstado(){
   var ajaxRequest = new XMLHttpRequest();
   //esta seccion es la encargada de recibir los datos enviados del servidor y actualizar los datos en la tabla
   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         //console.log("se ha actualizado el estado del bar");
         //console.log(ajaxRequest.responseText);
         $(".progress").html(ajaxRequest.responseText);
      }
   }

   var queryString ="?id="+$(".the_id_of_this_guardar").val();
   ajaxRequest.open("GET","php/actualizarBarEstado.php"+queryString,true);
   ajaxRequest.send();
}