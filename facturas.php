<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT facturas.total, facturas.fecha, facturas.id, GROUP_CONCAT(	servicios.NomServicio, '..',  servicios.DescServ, '..',  servicios.ID_Mascota, '..', servicios_realizados.cantidad SEPARATOR '__') AS servicios FROM facturas INNER JOIN servicios_realizados ON servicios_realizados.id_factura = facturas.id INNER JOIN servicios ON servicios.id = servicios_realizados.id_servicio GROUP BY facturas.id ORDER BY facturas.id;");
$facturas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>facturas</h1>
		<div>
			<a class="btn btn-success" href="./facturar.php">Nueva <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Número</th>
					<th>Fecha</th>
					<th>servicios vendidos</th>
					<th>Total</th>
					<th>Ticket</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($facturas as $facturas){ ?>
				<tr>
					<td><?php echo $facturas->id ?></td>
					<td><?php echo $facturas->fecha ?></td>
					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Servicio</th>
									<th>Descripción</th>
									<th>ID Mascota</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $facturas->servicios) as $serviciosConcatenados){ 
								$servicio = explode("..", $serviciosConcatenados)
								?>
								<tr>
									<td><?php echo $servicio[0] ?></td>
									<td><?php echo $servicio[1] ?></td>
									<td><?php echo $servicio[2] ?></td>
									<td><?php echo $servicio[3] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $facturas->total ?></td>
					<td><a class="btn btn-info" href="<?php echo "imprimirTicket.php?id=" . $facturas->id?>"><i class="fa fa-print"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarfactura.php?id=" . $facturas->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "pie.php" ?>