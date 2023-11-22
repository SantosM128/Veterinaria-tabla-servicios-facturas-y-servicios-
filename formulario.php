<?php include_once "encabezado.php" ?>

<div class="col-xs-12">
	<h1>Nuevo servicio</h1>
	<form method="post" action="nuevo.php">
	
			<label for="NomServicio">Nombre del Servicio:</label>
			<input class="form-control" name="NomServicio" required type="text" id="NomServicio" placeholder="Escribe el Nombre del Servicio">
			
			<label for="DescServ">Descripción:</label>
			<input class="form-control" name="DescServ" required type="text" id="DescServ" placeholder="Descripción">

			<label for="PrecioServ">Precio:</label>
			<input class="form-control" name="PrecioServ" required type="text" id="PrecioServ" placeholder="Escribe el Precio">

			<label for="fecha">Fecha:</label>
			<input class="form-control" name="fecha" required type="date" id="fecha" placeholder="fecha">

			<label for="ID_Mascota">ID de mascota:</label>
			<input class="form-control" name="ID_Mascota" required type="text" id="ID_Mascota" placeholder="Escribe el ID de la mascota">

			<label for="existencia">Existencia:</label>
			<input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
			
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "pie.php" ?>