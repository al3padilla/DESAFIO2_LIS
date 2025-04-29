<?php
class ClienteController {
    private $model;

    public function __construct() {
        require_once "app/models/Cliente.php";
        $this->model = new Cliente();
    }

    public function guardarRegistro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Valida que los datos no estén vacíos
            if (!empty($nombre) && !empty($email) && !empty($password)) {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->model->guardarCliente($nombre, $email, $hashPassword);

                // Devolver respuesta JSON de éxito
                http_response_code(200);
                echo json_encode(['mensaje' => 'Cliente registrado exitosamente']);
            } else {
                // Datos incompletos
                http_response_code(400);
                echo json_encode(['mensaje' => 'Faltan datos']);
            }
        }
    }

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $password = $_POST['password'] ?? '';

            // Buscar cliente por nombre de usuario
            $cliente = $this->model->obtenerClientePorNombre($usuario);

            if ($cliente && password_verify($password, $cliente['password'])) {
                // Autenticación exitosa
                session_start();
                $_SESSION['cliente'] = $cliente;

                http_response_code(200);
                echo json_encode(['mensaje' => 'Login exitoso']);
            } else {
                // Autenticación fallida
                http_response_code(401);
                echo json_encode(['mensaje' => 'Credenciales inválidas']);
            }
        }
    }
}
?>
