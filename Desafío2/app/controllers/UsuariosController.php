<?php
require_once __DIR__ . '/../models/Usuario.php';
session_start();

class UsuarioController {

    public function index() {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getAllUsuarios();
        require __DIR__ . '/../views/admin/usuarios.php';
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->getUsuarioById($id);

            if ($usuario) {
                require __DIR__ . '/../views/admin/modificar_usuario.php';
            } else {
                $_SESSION['error'] = 'Usuario no encontrado.';
                header('Location: /Desafío2/app/controllers/UsuariosController.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'ID de usuario no proporcionado.';
            header('Location: /Desafío2/app/controllers/UsuariosController.php');
            exit();
        }
    }
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $nombre = $_POST['nombre'];
            $usuario = $_POST['usuario'];
            $tipo = $_POST['tipo'];
    
            $nuevaContraseña = isset($_POST['nueva_contraseña']) ? $_POST['nueva_contraseña'] : null;
    
            if (!empty($nuevaContraseña)) {
                $contraseñaHash = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
            } else {
                $usuarioModel = new Usuario();
                $usuarioData = $usuarioModel->getUsuarioById($id);
                $contraseñaHash = $usuarioData['clave'];
            }
    
            $usuarioModel = new Usuario();
            $usuarioModel->actualizarUsuario($id, $nombre, $usuario, $contraseñaHash, $tipo);
    
            $_SESSION['success'] = 'Usuario actualizado correctamente.';
            header('Location: /Desafío2/app/controllers/UsuariosController.php');
            exit();
        } else {
            $_SESSION['error'] = 'Datos de formulario incompletos.';
            header('Location: /Desafío2/app/controllers/UsuariosController.php');
            exit();
        }
    }    

    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $usuarioModel = new Usuario();
            $usuarioModel->eliminarUsuario($id);

            $_SESSION['success'] = 'Usuario eliminado correctamente.';
            header('Location: /Desafío2/app/controllers/UsuariosController.php');
            exit();
        } else {
            $_SESSION['error'] = 'ID de usuario no proporcionado.';
            header('Location: /Desafío2/app/controllers/UsuariosController.php');
            exit();
        }
    }
}

$action = $_GET['action'] ?? 'index';
$controller = new UsuarioController();

switch ($action) {
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