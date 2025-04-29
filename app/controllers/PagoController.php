<?php
require_once '../models/Venta.php';
require_once '../models/Carrito.php';
require_once '../models/Producto.php';

session_start();

$venta = new Venta();
$carrito = new Carrito();
$producto = new Producto();

if (isset($_POST['procesar_pago'])) {
    $cliente_id = $_SESSION['cliente_id'];
    $total = $_POST['total'];

    $productosCarrito = $carrito->obtenerProductos($cliente_id);

    if (empty($productosCarrito)) {
        header('Location: /Desafío2/app/controllers/CarritoController.php');
        exit;
    }

    $fecha = date('Y-m-d H:i:s');
    $estado = 'Finalizada';

    $venta_id = $venta->insertarVenta($cliente_id, $fecha, $total, $estado);

    if ($venta_id) {
        foreach ($productosCarrito as $item) {
            $venta->insertarDetalleVenta(
                $venta_id,
                $item['producto_id'],
                $item['cantidad'],
                $item['precio']
            );

            $carrito->finalizarProductoCarrito($item['carrito_id']);

            $producto->reducirExistencias($item['producto_id'], $item['cantidad']);
        }

        header('Location: /Desafío2/app/controllers/CarritoController.php');
        exit;
    } else {
        header('Location: /Desafío2/app/controllers/CarritoController.php');
        exit;
    }
}
?>