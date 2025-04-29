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
            $nombre = trim($_POST['nombre']);
            $usuario = trim($_POST['usuario']);
            $tipo = trim($_POST['tipo']);
            $nuevaContraseña = isset($_POST['nueva_contraseña']) ? $_POST['nueva_contraseña'] : null;

            if (empty($nombre) || empty($usuario) || empty($tipo)) {
                $_SESSION['error'] = 'Todos los campos son requeridos.';
                header('Location: /Desafío2/app/controllers/UsuariosController.php?action=editar&id=' . $id);
                exit();
            }

            $usuarioModel = new Usuario();
            $usuarioExistente = $usuarioModel->getUsuarioByUsuario($usuario);
            if ($usuarioExistente && $usuarioExistente['id'] !== $id) {
                $_SESSION['error'] = 'El nombre de usuario ya está en uso.';
                header('Location: /Desafío2/app/controllers/UsuariosController.php?action=editar&id=' . $id);
                exit();
            }

            $contraseñaHash = null;
            if (!empty($nuevaContraseña)) {
                $contraseñaHash = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
            } else {
                $usuarioData = $usuarioModel->getUsuarioById($id);
                $contraseñaHash = $usuarioData['clave'];
            }

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