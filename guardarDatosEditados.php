<?php

#Salir si alguno de los datos no está presente
if(!isset($_POST["NomServicio"]) || !isset($_POST["DescServ"]) || !isset($_POST["PrecioServ"]) || !isset($_POST["fecha"]) || !isset($_POST["ID_Mascota"]) || !isset($_POST["existencia"])){ exit(); }


#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$id = $_POST["id"];
$NomServicio = $_POST["NomServicio"];
$DescServ = $_POST["DescServ"];
$PrecioServ = $_POST["PrecioServ"];
$fecha = $_POST["fecha"];
$ID_Mascota = $_POST["ID_Mascota"];
$existencia = $_POST["existencia"];

$sentencia = $base_de_datos->prepare("UPDATE servicios SET NomServicio = ?, DescServ = ?, PrecioServ = ?, fecha = ?, ID_Mascota = ?, existencia = ? WHERE id = ?;");
$resultado = $sentencia->execute([$NomServicio, $DescServ, $PrecioServ, $fecha, $ID_Mascota, $existencia, $id]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del servicio";
?>