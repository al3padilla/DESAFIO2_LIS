<?php
require_once '../models/Carrito.php';
require_once '../models/Producto.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['usuario'])) {
    $cliente_id = $_SESSION['usuario']['id'];
    
    $carritoModel = new Carrito();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_carrito'])) {
        $producto_id = $_POST['producto_id'];
        $cantidad = $_POST['cantidad'];
        
        $productoExistente = $carritoModel->obtenerProductos($cliente_id);
        
        $producto_en_carrito = false;
        foreach ($productoExistente as $producto) {
            if ($producto['producto_id'] == $producto_id) {
                $producto_en_carrito = true;
                break;
            }
        }

        if ($producto_en_carrito) {
            $carritoModel->actualizarCantidad($producto['carrito_id'], $producto['cantidad'] + $cantidad);
        } else {
            $carritoModel->agregarProducto($cliente_id, $producto_id, $cantidad);
        }

        header('Location: /Desafío2/app/views/catalogo');
        exit;
    }

    if (isset($_GET['eliminar'])) {
        $carrito_id = $_GET['eliminar'];
        $carritoModel->eliminarProducto($carrito_id);
        header('Location: /Desafío2/app/controllers/CarritoController.php');
        exit;
    }

    if (isset($_POST['actualizar_cantidad'])) {
        $carrito_id = $_POST['carrito_id'];
        $cantidad = $_POST['cantidad'];
        $carritoModel->actualizarCantidad($carrito_id, $cantidad);
        header('Location: /Desafío2/app/controllers/CarritoController.php');
        exit;
    }

    $productosCarrito = $carritoModel->obtenerProductos($cliente_id);
    require '../views/carrito/carrito.php';
} else {
    header('Location: /Desafío2/app/views/cliente/LoginCliente.php');
    exit;
}
?>