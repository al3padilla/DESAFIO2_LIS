<?php
class Login {
    private $db;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'textilexport';
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

    public function obtenerAdminPorUsuario($usuario) {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND tipo = 'admin'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        public function verificarCliente($usuario, $password) {
            $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND tipo = 'cliente'";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();
    
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($cliente && password_verify($password, $cliente['clave'])) {
                return $cliente; 
            }
    
            return false;
        }
}
?>
