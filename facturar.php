<?php
session_start();
include_once "encabezado.php";
if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
<div class="col-xs-12">
	<h1>facturar</h1>
	<?php
	if (isset($_GET["status"])) {
		if ($_GET["status"] === "1") {
	?>
			<div class="alert alert-success">
				<strong>¡Correcto!</strong> factura realizada correctamente
			</div>
		<?php
		} else if ($_GET["status"] === "2") {
		?>
			<div class="alert alert-info">
				<strong>factura cancelada</strong>
			</div>
		<?php
		} else if ($_GET["status"] === "3") {
		?>
			<div class="alert alert-info">
				<strong>Ok</strong> servicio quitado de la lista
			</div>
		<?php
		} else if ($_GET["status"] === "4") {
		?>
			<div class="alert alert-warning">
				<strong>Error:</strong> El servicio que buscas no existe
			</div>
		<?php
		} else if ($_GET["status"] === "5") {
		?>
			<div class="alert alert-danger">
				<strong>Error: </strong>El servicio está agotado
			</div>
		<?php
		} else {
		?>
			<div class="alert alert-danger">
				<strong>Error:</strong> Algo salió mal mientras se realizaba la factura
			</div>
	<?php
		}
	}
	?>
	<br>
	<form method="post" action="agregarAlCarrito.php">
		<label for="NomServicio">Código de barras:</label>
		<input autocomplete="off" autofocus class="form-control" name="NomServicio" required type="text" id="NomServicio" placeholder="Escribe el código">
	</form>
	<br><br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre servicio</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Fecha</th>
				<th>ID mascota</th>
				<th>Existencia</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th>Quitar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($_SESSION["carrito"] as $indice => $servicio) {
				$granTotal += $servicio->total;
			?>
				<tr>
					<td><?php echo $servicio->id ?></td>
					<td><?php echo $servicio->NomServicio ?></td>
					<td><?php echo $servicio->DescServ ?></td>
					<td><?php echo $servicio->PrecioServ ?></td>
					<td><?php echo $servicio->fecha ?></td>
					<td><?php echo $servicio->ID_Mascota ?></td>
					<td><?php echo $servicio->existencia ?></td>
					<td>
						<form action="cambiar_cantidad.php" method="post">
							<input name="indice" type="hidden" value="<?php echo $indice; ?>">
							<input min="1" name="cantidad" class="form-control" required type="number" step="0.1" value="<?php echo $servicio->cantidad; ?>">
						</form>
					</td>
					<td><?php echo $servicio->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<h3>Total: <?php echo $granTotal; ?></h3>
	<form action="./terminarfactura.php" method="POST">
		<input name="total" type="hidden" value="<?php echo $granTotal; ?>">
		<button type="submit" class="btn btn-success">Terminar factura</button>
		<a href="./cancelarfactura.php" class="btn btn-danger">Cancelar factura</a>
	</form>
</div>
<?php include_once "pie.php" ?>