<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM servicios WHERE id = ?;");
$sentencia->execute([$id]);
$servicio = $sentencia->fetch(PDO::FETCH_OBJ);
if($servicio === FALSE){
	echo "¡No existe algún servicio con ese ID!";
	exit();
}

?>
<?php include_once "encabezado.php" ?>
	<div class="col-xs-12">
		<h1>Editar servicio con el ID <?php echo $servicio->id; ?></h1>
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id" value="<?php echo $servicio->#; ?>">
	
			<label for="NomServicio">Nombre del Servicio:</label>
			<input value="<?php echo $servicio->NomServicio ?>" class="form-control" name="NomServicio" required type="text" id="NomServicio" placeholder="Escribe la NomServicio">
			
			<label for="DescServ">Descripción:</label>
			<input value="<?php echo $servicio->DescServ ?>" class="form-control" name="DescServ" required type="text" id="DescServ" placeholder="DescServ">

			<label for="PrecioServ">Precio:</label>
			<input value="<?php echo $servicio->PrecioServ ?>" class="form-control" name="PrecioServ" required type="text" id="PrecioServ" placeholder="Escribe el PrecioServ">

			<label for="fecha">Fecha:</label>
			<input value="<?php echo $servicio->fecha ?>" class="form-control" name="fecha" required type="date" id="fecha" placeholder="fecha">

			<label for="ID_Mascota">ID de mascota:</label>
			<input value="<?php echo $servicio->ID_Mascota ?>" class="form-control" name="ID_Mascota" required type="text" id="ID_Mascota" placeholder="id">

			<label for="existencia">Existencia:</label>
			<input value="<?php echo $servicio->existencia ?>" class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
			
			<br><br><input class="btn btn-info" type="submit" value="Guardar">
			<a class="btn btn-warning" href="./listar.php">Cancelar</a>
		</form>
	</div>
<?php include_once "pie.php" ?>
