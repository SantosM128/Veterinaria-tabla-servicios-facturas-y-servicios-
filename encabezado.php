<?php
/*
	Pequeño, muy pequeño sistema de ventas en PHP con MySQL

	@author parzibyte

	No olvides visitar parzibyte.me/blog para más cosas como esta
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Veterinaria</title>
	
	<link rel="stylesheet" href="./css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/2.css">
	<link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" style="border: purple; background-color: purple;">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Veterinaria</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="./listar.php">Servicios</a></li>
					<li><a href="./facturar.php">Facturar</a></li>
					<li><a href="./facturas.php">Servicios realizados</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">