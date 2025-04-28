<?php
class Carrito {
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

    public function agregarProducto($cliente_id, $producto_id, $cantidad) {
        try {
            $estado = 'Pendiente'; 
    
            $stmt = $this->db->prepare("INSERT INTO carrito (cliente_id, producto_id, cantidad, estado) 
                                        VALUES (:cliente_id, :producto_id, :cantidad, :estado)");
    
            $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
            $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al agregar al carrito: " . $e->getMessage();
        }
    }
}
?>