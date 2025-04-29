<?php
class Producto {
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

    public function getAllProductos() {
        $sql = "SELECT id, codigo, nombre, descripcion, imagen, categoria, precio, existencias
                FROM productos
                WHERE existencias > 0";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   

    public function getAllProductos2() {
        $sql = "SELECT id, codigo, nombre, descripcion, imagen, categoria, precio, existencias
                FROM productos";
        $stmt = $this->db->query($sql);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  

    public function insertarProducto($codigo, $nombre, $descripcion, $imagen, $categoria, $precio, $existencias) {
        $sql = "INSERT INTO productos (codigo, nombre, descripcion, imagen, categoria, precio, existencias)
                VALUES (:codigo, :nombre, :descripcion, :imagen, :categoria, :precio, :existencias)";
        
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':existencias', $existencias);

        $stmt->execute();
    }

    public function eliminarProducto($id) {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
public function getProductoById($id) {
    $sql = "SELECT * FROM productos WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function actualizarProducto($id, $codigo, $nombre, $descripcion, $imagen, $categoria, $precio, $existencias) {
    $sql = "UPDATE productos SET codigo = :codigo, nombre = :nombre, descripcion = :descripcion, imagen = :imagen, categoria = :categoria, precio = :precio, existencias = :existencias WHERE id = :id";
    
    $stmt = $this->db->prepare($sql);
    
    $stmt->bindParam(':codigo', $codigo);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':imagen', $imagen);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':existencias', $existencias);
    $stmt->bindParam(':id', $id);
    
    $stmt->execute();
}

public function reducirExistencias($producto_id, $cantidad)
{
    try {
        $query = "UPDATE productos SET existencias = existencias - :cantidad WHERE id = :producto_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error al reducir existencias: " . $e->getMessage();
    }
}
}