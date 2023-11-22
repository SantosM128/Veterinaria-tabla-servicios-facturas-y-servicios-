<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM servicios;");
$servicios = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>servicios</h1>
		<div>
			<a class="btn btn-success" href="./formulario.php">Nuevo <i class="fa fa-plus"></i></a>
		</div>
		<br>
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
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($servicios as $servicio){ ?>
				<tr>
					<td><?php echo $servicio->id ?></td>
					<td><?php echo $servicio->NomServicio ?></td>
					<td><?php echo $servicio->DescServ ?></td>
					<td><?php echo $servicio->PrecioServ ?></td>
					<td><?php echo $servicio->fecha ?></td>
					<td><?php echo $servicio->ID_Mascota ?></td>
					<td><?php echo $servicio->existencia ?></td>
					<td><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $servicio->id?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminar.php?id=" . $servicio->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "pie.php" ?>