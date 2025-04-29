<?php
session_start();

require_once '../models/Producto.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = $_POST['codigo'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $categoria = $_POST['categoria'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $existencias = $_POST['existencias'] ?? 0;

            if (empty($codigo)) {
                $errores[] = "El código es obligatorio.";
            }
            if (empty($nombre)) {
                $errores[] = "El nombre es obligatorio.";
            }
            if (empty($descripcion)) {
                $errores[] = "La descripción es obligatoria.";
            }
            if (empty($precio) || $precio <= 0) {
                $errores[] = "El precio debe ser mayor a 0.";
            }
            if (empty($existencias) || $existencias < 0) {
                $errores[] = "Las existencias no pueden ser negativas.";
            }

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $imagen = $_FILES['imagen'];
                $imagenNombre = time() . "_" . basename($imagen['name']);
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/Desafío2/public/img/" . $imagenNombre;

                if (!move_uploaded_file($imagen['tmp_name'], $targetDir)) {
                    $errores[] = "Hubo un error al subir la imagen.";
                }
            } else {
                $errores[] = "La imagen es obligatoria.";
            }

            if (empty($errores)) {
                $productoModel = new Producto();
                $productoModel->insertarProducto($codigo, $nombre, $descripcion, $imagenNombre, $categoria, $precio, $existencias);

                $_SESSION['success'] = 'Producto agregado correctamente.';
                require_once 'Desafío2/app/controllers/ProductoController.php';
                exit();
            } else {
                require_once '../views/admin/agregar_producto.php';
                exit();
            }
        }

        require_once 'Desafío2/app/controllers/ProductoController.php';

    session_destroy();
?>