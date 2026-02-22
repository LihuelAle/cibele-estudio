<?php
require_once __DIR__ . '/../../config/db.php';

class Producto {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM productos ORDER BY fecha_creacion DESC";
        $result = $this->conn->query($sql);

        $productos = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }

    public function insertar($nombre, $descripcion, $precio, $imagen = null) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizar($id, $nombre, $descripcion, $precio, $imagen = null) {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen, $id);
        return $stmt->execute();
    }
}
?>