<?php
session_start();
require_once __DIR__ . '/../models/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
    $usuario = htmlspecialchars(trim($_POST['usuario'] ?? ''));
    $password = $_POST['password'] ?? '';
    $tipo = $_POST['tipo'] ?? 'Cliente'; 

    if (empty($nombre) || empty($usuario) || empty($password) || empty($tipo)) {
        $_SESSION['error'] = 'Por favor, complete todos los campos.';
        header("Location: /Desafío2/app/views/cliente/RegistroCliente.php");
        exit();
    }

    $cliente = new Cliente(); 

    if ($cliente->obtenerClientePorNombre($usuario)) {
        $_SESSION['error'] = 'El usuario ya existe. Por favor, elija otro nombre de usuario.';
        header("Location: /Desafío2/app/views/cliente/RegistroCliente.php"); 
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($cliente->guardarCliente($nombre, $usuario, $hashedPassword, $tipo)) {
        $_SESSION['success'] = '¡Cliente registrado exitosamente!';
        header("Location: /Desafío2/app/views/cliente/LoginCliente.php"); 
        exit();
    } else {
        $_SESSION['error'] = 'Hubo un error al registrar al cliente. Intente nuevamente.';
        header("Location: /Desafío2/app/views/cliente/RegistroCliente.php"); 
        exit();
    }
}
session_destroy();
?>