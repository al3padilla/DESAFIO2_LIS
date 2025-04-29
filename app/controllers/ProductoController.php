<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    
    public function index() {
        $productoModel = new Producto();
        $productos = $productoModel->getAllProductos2();
        require __DIR__ . '/../views/admin/inventario.php';
    }

    public function agregar() {
        require __DIR__ . '/../views/admin/agregar_producto.php';
    }

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

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
            $existencias = $_POST['existencias'];
    
            $productoModel = new Producto();
            $productoExistente = $productoModel->getProductoById($id);
    
            $imagen = $productoExistente['imagen'];
    
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                // Subir nueva imagen
                $nombreImagen = time() . '_' . basename($_FILES['imagen']['name']);
                $rutaDestino = __DIR__ . '/../../public/img/' . $nombreImagen;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
                $imagen = $nombreImagen;
            }
    
            $productoModel->actualizarProducto($id, $codigo, $nombre, $descripcion, $imagen, $categoria, $precio, $existencias);
    
            $_SESSION['success'] = 'Producto actualizado correctamente';
            header('Location: /Desafío2/app/controllers/ProductoController.php');
            exit();
        }
    }    

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