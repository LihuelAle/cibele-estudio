<?php
require_once dirname(__FILE__) . '/../../config/database.php';

class Pedido {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Crear pedido
    public function crear($email, $nombre, $telefono, $direccion, $total) {
        $query = "INSERT INTO pedidos (email_cliente, nombre_cliente, telefono, direccion, total, estado) 
                  VALUES (?, ?, ?, ?, ?, 'pendiente')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssd", $email, $nombre, $telefono, $direccion, $total);
        
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }

    // Agregar detalle del pedido
    public function agregarDetalle($pedido_id, $producto_id, $cantidad, $precio_unitario) {
        $query = "INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad, precio_unitario) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiid", $pedido_id, $producto_id, $cantidad, $precio_unitario);
        return $stmt->execute();
    }

    // Obtener todos los pedidos
    public function obtenerTodos() {
        $query = "SELECT * FROM pedidos ORDER BY creado_en DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener pedido con detalles
    public function obtenerConDetalles($id) {
        $query = "SELECT p.*, 
                         GROUP_CONCAT(CONCAT(pr.nombre, ' (x', d.cantidad, ')') SEPARATOR ', ') as productos
                  FROM pedidos p
                  LEFT JOIN detalles_pedido d ON p.id = d.pedido_id
                  LEFT JOIN productos pr ON d.producto_id = pr.id
                  WHERE p.id = ?
                  GROUP BY p.id";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar estado del pedido
    public function actualizarEstado($id, $estado) {
        $query = "UPDATE pedidos SET estado = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $estado, $id);
        return $stmt->execute();
    }

    // Obtener pedidos pendientes
    public function obtenerPendientes() {
        $query = "SELECT * FROM pedidos WHERE estado = 'pendiente' ORDER BY creado_en DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>