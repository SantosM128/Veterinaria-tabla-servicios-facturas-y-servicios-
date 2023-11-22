<?php
if (!isset($_GET["id"])) {
    exit("No hay id");
}
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT id, fecha, total FROM facturas WHERE id = ?");
$sentencia->execute([$id]);
$factura = $sentencia->fetchObject();
if (!$factura) {
    exit("No existe factura con el id proporcionado");
}

$sentenciaservicios = $base_de_datos->prepare("SELECT p.id, p.NomServicio, p.DescServ, p.PrecioServ, pv.cantidad
FROM servicios p
INNER JOIN 
servicios_realizados pv
ON p.id = pv.id_servicio
WHERE pv.id_factura = ?");
$sentenciaservicios->execute([$id]);
$servicios = $sentenciaservicios->fetchAll();
if (!$servicios) {
    exit("No hay servicios");
}

?>
<style>
    * {
        font-size: 20px;
        font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.servicio,
    th.servicio {
        width: 300px;
    }
    td.nom,
    th.nom{
        width: 180px;
    }

    td.cantidad,
    th.cantidad {
        width: 90px;
    }

    td.costo,
    th.costo {
        width: 50px;
        text-align: right;
    }

    .centrado {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 800px;
        max-width: 800px;
    }

    .cos {
        width: 120px;
    }

    @media print {

        .oculto-impresion,
        .oculto-impresion * {
            display: none !important;
        }
    }
</style>

<body>
    <div class="ticket">
        <h2>Veterinaria</h2>
        <p class="centrado">TICKET DE FACTURA
            <br><?php echo $factura->fecha; ?>
        </p>
        <table>
            <thead>
                <tr>
                    <th class="cantidad">CANT</th>
                    <th class="cantidad">ID</th>
                    <th class="nom">SERVICIO</th>
                    <th class="servicio">DESCRIPCIÓN</th>
                    <th class="cos">PRECIO</th>
                    <th class="costo">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($servicios as $servicio) {
                    $subtotal = $servicio->PrecioServ * $servicio->cantidad;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td class="cantidad" style="text-align:center;"><?php echo $servicio->cantidad;  ?></td>
                        <td class="cantidad" style="text-align:center;"><?php echo $servicio->id;  ?></td>
                        <td class="nom" style="text-align:center;"><?php echo $servicio->NomServicio;  ?></td>
                        <td class="cos" style="text-align:center;"><?php echo $servicio->DescServ;  ?></td>
                        <td class="cantidad" style="text-align:center;"><strong>$<?php echo number_format($servicio->PrecioServ, 2) ?></strong></td>
                        <td class="costo">$<?php echo number_format($subtotal, 2)  ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" style="text-align: right;">TOTAL</td>
                    <td class="costo">
                        <strong>$<?php echo number_format($total, 2) ?></strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br><br>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
        </p>
    </div>
</body>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        setTimeout(() => {
            window.location.href = "./facturas.php";
        }, 1000);
    });
</script>