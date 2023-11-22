<?php
if (!isset($_POST["NomServicio"])) {
    return;
}

$NomServicio = $_POST["NomServicio"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM servicios WHERE id = ? LIMIT 1;");
$sentencia->execute([$NomServicio]);
$servicio = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$servicio) {
    header("Location: ./facturar.php?status=4");
    exit;
}
# Si no hay existencia...
if ($servicio->existencia < 1) {
    header("Location: ./facturar.php?status=5");
    exit;
}
session_start();
# Buscar servicio dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->NomServicio === $NomServicio) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $servicio->cantidad = 1;
    $servicio->total = $servicio->PrecioServ;
    array_push($_SESSION["carrito"], $servicio);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + 1 > $servicio->existencia) {
        header("Location: ./facturar.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->cantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->PrecioServ;
}
header("Location: ./facturar.php");
