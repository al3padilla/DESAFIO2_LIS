<?php
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Producto.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class VentaController {

    public function index() {
        $ventaModel = new Venta();
        $ventas = $ventaModel->getAllVentas();
        require __DIR__ . '/../views/admin/ventas.php';
    }    
}

$action = $_GET['action'] ?? 'index';

$controller = new VentaController();

switch ($action) {
    case 'index':
    default:
        $controller->index();
        break;
}