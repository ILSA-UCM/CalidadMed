<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
	<meta name="description" content="AENOR, TFG, UCM, FDI, 2016">
	<meta name="author" content="Andrea, Chaymae">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title> TFG - AENOR </title>
	
	<!--LIBRERIAS EXTERNAS-->
	<link rel="stylesheet" href="libs/bootstrap/3_3_6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="libs/nestable/css/nestable.css">
  
  <script src="libs/jquery/1_12_0/jquery.min.js"></script>
  <script src="libs/bootstrap/3_3_6/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="libs/nestable/js/jquery.nestable.js"></script>
  <script src="libs/json/jquery.json.min.js"></script>

  <!--Nuestros recursos-->
  <link rel="stylesheet" type="text/css" href="css/nuestros_estilos.css" />
  <script src="ajax/funciones_bd.js"></script>
  <script src="js/script.js"></script>
  <link rel="shortcut icon" href="img/favicon.ico" />
    
</head>
<body>

<!-- Cabecera de la web -->
  <header id="main-header">
    <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- El logotipo y el icono que despliega el menú se agrupan
           para mostrarlos mejor en los dispositivos móviles -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".miNavbar">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">AENOR</a>
        </div>
        <!-- Agrupar los enlaces de navegación, los formularios y cualquier
         otro elemento que se pueda ocultar al minimizar la barra -->
        <div class="collapse navbar-collapse miNavbar">
          <ul class="nav navbar-nav">
            <li id="home" class="active"><a href="index.php">Home</a></li>
            <li id="oas"><a href="oas.php">Materiales</a></li>
            <li id="configuracion"><a href="criterios.php">Configuración</a></li>
            <li id="glosario"><a href="glosario.php?pagina=1">Glosario</a></li>
            <li id="creditos"><a href="creditos.php">Cr&eacute;ditos</a></li>
          </ul>
          </div>
      </div>
    </nav>
  </header>