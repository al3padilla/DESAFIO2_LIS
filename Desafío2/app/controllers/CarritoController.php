<?php
require_once '../models/Carrito.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_carrito'])) {
    session_start();

    if (isset($_SESSION['usuario'])) {
        $cliente_id = $_SESSION['usuario']['id'];
        $producto_id = $_POST['producto_id'];
        $cantidad = $_POST['cantidad'];

        $carrito = new Carrito();
        $carrito->agregarProducto($cliente_id, $producto_id, $cantidad);

        header('Location: /Desafío2/app/views/catalogo');
        exit;
    } else {
        header('Location: /Desafío2/app/views/cliente/LoginCliente.php');
        exit;
    }
}
?>