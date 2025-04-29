<?php
class Venta{
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

    public function insertarVenta($cliente_id, $fecha, $total, $estado) {
        $sql = "INSERT INTO ventas (cliente_id, fecha, total, estado) VALUES (:cliente_id, :fecha, :total, :estado)";
        $stmt = $this->db->prepare($sql);
    
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':estado', $estado);
    
        $stmt->execute();
    
        return $this->db->lastInsertId();
    }

    public function insertarDetalleVenta($venta_id, $producto_id, $cantidad, $precio_unitario) {
        $sql = "INSERT INTO detalle_ventas (venta_id, producto_id, cantidad, precio_unitario) 
                VALUES (:venta_id, :producto_id, :cantidad, :precio_unitario)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':venta_id', $venta_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':precio_unitario', $precio_unitario);
        
        $stmt->execute();
    }      

    public function getAllVentas() {
        $sql = "SELECT v.id, v.cliente_id, v.fecha, v.total, v.estado, u.nombre AS cliente_nombre
                FROM ventas v
                INNER JOIN usuarios u ON v.cliente_id = u.id
                ORDER BY v.fecha DESC"; // Ordenar por fecha de forma descendente
        
        $stmt = $this->db->query($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
