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

    public function obtenerProductos($cliente_id) {
        $query = "SELECT c.id AS carrito_id, p.id AS producto_id, p.nombre, c.cantidad, p.precio 
                  FROM carrito c
                  INNER JOIN productos p ON c.producto_id = p.id
                  WHERE c.cliente_id = :cliente_id AND c.estado = 'Pendiente'";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function eliminarProducto($carrito_id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM carrito WHERE id = :carrito_id");
            $stmt->bindParam(':carrito_id', $carrito_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar el producto del carrito: " . $e->getMessage();
        }
    }
    
    public function actualizarCantidad($carrito_id, $cantidad) {
        try {
            $stmt = $this->db->prepare("UPDATE carrito SET cantidad = :cantidad WHERE id = :carrito_id");
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(':carrito_id', $carrito_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar la cantidad: " . $e->getMessage();
        }
    }

    public function finalizarProductoCarrito($carrito_id) {
        $sql = "UPDATE carrito SET estado = 'Finalizado' WHERE id = :carrito_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':carrito_id', $carrito_id);
        $stmt->execute();
    }
    
}
?>