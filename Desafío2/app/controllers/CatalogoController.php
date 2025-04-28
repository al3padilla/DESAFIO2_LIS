<?php
require_once __DIR__ . '/../models/Producto.php';

class CAtalogoController {
    public function index() {
        $productoModel = new Producto();
        $productos = $productoModel->getAllProductos();

        require __DIR__ . '/../views/catalogo/index.php';
    }
}


$action = $_GET['action'] ?? 'index';
$controller = new CatalogoController();
$controller->$action(); 
?>

