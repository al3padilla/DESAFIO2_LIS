<?php
session_start();
require_once __DIR__ . '/../models/login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = htmlspecialchars(trim($_POST['usuario'] ?? ''));
    $clave = $_POST['clave'] ?? '';

    if (empty($usuario) || empty($clave)) {
        $_SESSION['error'] = 'Por favor, complete todos los campos.';
        header("Location: /Desafío2/app/views/cliente/LoginAdmin.php");
        exit();
    }

    $admin = new Login();

    $adminData = $admin->obtenerAdminPorUsuario($usuario);

    if ($adminData && password_verify($clave, $adminData['clave'])) {
        $_SESSION['admin'] = $adminData;
        $_SESSION['success'] = '¡Bienvenido Administrador!';
        header("Location: /Desafío2/app/controllers/ProductoController.php"); 
        exit();
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos.';
        header("Location: /Desafío2/app/views/cliente/LoginAdmin.php");
        exit();
    }
}
session_destroy();
?>