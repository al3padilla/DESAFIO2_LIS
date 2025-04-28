<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    
    public function index() {
        $productoModel = new Producto();
        $productos = $productoModel->getAllProductos();
        require __DIR__ . '/../views/admin/inventario.php';
    }

    // Mostrar el formulario para agregar un nuevo producto
    public function agregar() {
        require __DIR__ . '/../views/admin/agregar_producto.php';
    }

    // Mostrar el formulario para editar un producto
    public function editar() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $productoModel = new Producto();
            $producto = $productoModel->getProductoById($id);
            
            if ($producto) {
                require __DIR__ . '/../views/admin/modificar_producto.php';
            } else {
                $_SESSION['error'] = 'Producto no encontrado.';
                header('Location: /Desafío2/app/controllers/ProductoController.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'ID de producto no proporcionado.';
            header('Location: /Desafío2/app/controllers/ProductoController.php');
            exit();
        }
    }

    // Actualizar producto en la base de datos
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $imagen = $_POST['imagen'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
            $existencias = $_POST['existencias'];

            $productoModel = new Producto();
            $productoModel->actualizarProducto($id, $codigo, $nombre, $descripcion, $imagen, $categoria, $precio, $existencias);

            $_SESSION['success'] = 'Producto actualizado correctamente';
            header('Location: /Desafío2/app/controllers/ProductoController.php');
            exit();
        }
    }

    // Eliminar un producto de la base de datos
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $productoModel = new Producto();
            $productoModel->eliminarProducto($id);
            $_SESSION['success'] = 'Producto eliminado correctamente';
            header('Location: /Desafío2/app/controllers/ProductoController.php');
            exit();
        }
    }
}

// Manejar las acciones solicitadas
$action = $_GET['action'] ?? 'index';
$controller = new ProductoController();

switch ($action) {
    case 'agregar':
        $controller->agregar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'actualizar':
        $controller->actualizar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    default:
        $controller->index();
        break;
}
?>