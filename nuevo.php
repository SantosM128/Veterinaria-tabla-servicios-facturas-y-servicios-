<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["NomServicio"]) || !isset($_POST["DescServ"]) || !isset($_POST["PrecioServ"]) || !isset($_POST["fecha"]) || !isset($_POST["ID_Mascota"]) || !isset($_POST["existencia"])){ exit(); }
#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$NomServicio = $_POST["NomServicio"];
$DescServ = $_POST["DescServ"];
$PrecioServ = $_POST["PrecioServ"];
$fecha = $_POST["fecha"];
$ID_Mascota = $_POST["ID_Mascota"];
$existencia = $_POST["existencia"];

$sentencia = $base_de_datos->prepare("INSERT INTO `servicios`(`NomServicio`, `DescServ`, `PrecioServ`, `fecha`, `ID_Mascota`, `existencia`) VALUES (?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$NomServicio, $DescServ, $PrecioServ, $fecha, $ID_Mascota, $existencia]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "pie.php" ?>