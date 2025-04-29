<?php
class Cliente {
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
    public function guardarCliente($nombre, $usuario, $password, $tipo) {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false; 
        }
        $sql = "INSERT INTO usuarios (nombre, usuario, clave, tipo) VALUES (:nombre, :usuario, :clave, :tipo)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':clave', $password); 
        $stmt->bindParam(':tipo', $tipo);
        return $stmt->execute(); 
    }
    
    public function obtenerClientePorNombre($nombre) {
        $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>