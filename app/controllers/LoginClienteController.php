<?php
session_start();
require_once __DIR__ . '/../models/login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = htmlspecialchars(trim($_POST['usuario'] ?? ''));
    $password = $_POST['clave'] ?? '';

    if (empty($usuario) || empty($password)) {
        $_SESSION['error'] = 'Por favor, ingrese su usuario y contraseña.';
        header("Location: /Desafío2/app/views/cliente/LoginCliente.php");
        exit();
    }

    $cliente = new Login();
    $user = $cliente->verificarCliente($usuario, $password);

    if ($user && password_verify($password, $user['clave'])) {

        $_SESSION['cliente_id'] = $user['id'];
        $_SESSION['usuario'] = $user;

        header("Location: /Desafío2/app/views/catalogo");
        exit();
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos.';
        header("Location: /Desafío2/app/views/cliente/LoginCliente.php");
        exit();
    }
}
?>