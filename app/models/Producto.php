<?php
require_once dirname(__FILE__) . '/../../config/database.php';

class Producto {
    private $db;

    // Constructor - SOLO UNO
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Obtener todos los productos activos
    public function obtenerTodos() {
        $query = "SELECT * FROM productos WHERE activo = 1 ORDER BY creado_en DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener producto por ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM productos WHERE id = ? AND activo = 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Crear nuevo producto
    public function crear($nombre, $descripcion, $precio, $imagen, $cantidad) {
        $query = "INSERT INTO productos (nombre, descripcion, precio, imagen, cantidad_disponible) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen, $cantidad);
        
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }

    // Actualizar producto
    public function actualizar($id, $nombre, $descripcion, $precio, $imagen, $cantidad, $activo) {
        $query = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, 
                  imagen = ?, cantidad_disponible = ?, activo = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssdsiii", $nombre, $descripcion, $precio, $imagen, $cantidad, $activo, $id);
        return $stmt->execute();
    }

    // Eliminar producto (soft delete)
    public function eliminar($id) {
        $query = "UPDATE productos SET activo = 0 WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Buscar productos
    public function buscar($termino) {
        $query = "SELECT * FROM productos WHERE activo = 1 AND 
                  (nombre LIKE ? OR descripcion LIKE ?) ORDER BY nombre";
        $termino = "%$termino%";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $termino, $termino);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Reducir cantidad disponible
    public function reducirCantidad($id, $cantidad) {
        $query = "UPDATE productos SET cantidad_disponible = cantidad_disponible - ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $cantidad, $id);
        return $stmt->execute();
    }
}
?>