<?php
if(!isset($_POST["total"])) exit;


session_start();


$total = $_POST["total"];
include_once "base_de_datos.php";


$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT INTO facturas(fecha, total) VALUES (?, ?);");
$sentencia->execute([$ahora, $total]);

$sentencia = $base_de_datos->prepare("SELECT id FROM facturas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idfactura = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO servicios_realizados(id_servicio, id_factura, cantidad) VALUES (?, ?, ?)");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE servicios SET existencia = existencia - ? WHERE id = ?;");
foreach ($_SESSION["carrito"] as $servicio) {
	$total += $servicio->total;
	$sentencia->execute([$servicio->id, $idfactura, $servicio->cantidad]);
	$sentenciaExistencia->execute([$servicio->cantidad, $servicio->id]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./facturar.php?status=1");
?>