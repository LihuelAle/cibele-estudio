<?php
require_once dirname(__FILE__) . '/../models/Pedido.php';
require_once dirname(__FILE__) . '/../models/Producto.php';
require_once dirname(__FILE__) . '/../../config/constants.php';

class PedidoController {
    private $pedido;
    private $producto;

    public function __construct() {
        $this->pedido = new Pedido();
        $this->producto = new Producto();
    }

    // Crear pedido desde carrito
    public function crearDesdeCarrito($email, $nombre, $telefono, $direccion, $carrito) {
        $total = 0;
        
        // Validar stock y calcular total
        foreach ($carrito as $item) {
            $prod = $this->producto->obtenerPorId($item['id']);
            if (!$prod || $prod['cantidad_disponible'] < $item['cantidad']) {
                return ['error' => 'Stock insuficiente para ' . $prod['nombre']];
            }
            $total += $prod['precio'] * $item['cantidad'];
        }

        // Crear pedido
        $pedido_id = $this->pedido->crear($email, $nombre, $telefono, $direccion, $total);
        
        if ($pedido_id) {
            // Agregar detalles y reducir stock
            foreach ($carrito as $item) {
                $prod = $this->producto->obtenerPorId($item['id']);
                $this->pedido->agregarDetalle($pedido_id, $item['id'], $item['cantidad'], $prod['precio']);
                $this->producto->reducirCantidad($item['id'], $item['cantidad']);
            }

            // Enviar email a admin
            $this->enviarEmailAdmin($pedido_id, $email, $nombre);

            return ['success' => 'Pedido creado exitosamente', 'pedido_id' => $pedido_id];
        }
        return ['error' => 'Error al crear el pedido'];
    }

    // Obtener todos los pedidos
    public function listar() {
        return $this->pedido->obtenerTodos();
    }

    // Obtener pedido con detalles
    public function obtener($id) {
        return $this->pedido->obtenerConDetalles($id);
    }

    // Actualizar estado
    public function actualizarEstado($id, $estado) {
        $estados_validos = ['pendiente', 'confirmado', 'enviado', 'entregado'];
        if (!in_array($estado, $estados_validos)) {
            return ['error' => 'Estado inválido'];
        }

        if ($this->pedido->actualizarEstado($id, $estado)) {
            $ped = $this->pedido->obtenerConDetalles($id);
            $this->enviarEmailCliente($ped['email_cliente'], $ped['nombre_cliente'], $estado);
            return ['success' => 'Estado actualizado exitosamente'];
        }
        return ['error' => 'Error al actualizar el estado'];
    }

    // Obtener pedidos pendientes
    public function obtenerPendientes() {
        return $this->pedido->obtenerPendientes();
    }

    // Enviar email al admin
    private function enviarEmailAdmin($pedido_id, $email_cliente, $nombre_cliente) {
        $asunto = "Nuevo pedido #$pedido_id de $nombre_cliente";
        $mensaje = "Se ha recibido un nuevo pedido:\n\n";
        $mensaje .= "Pedido ID: $pedido_id\n";
        $mensaje .= "Cliente: $nombre_cliente\n";
        $mensaje .= "Email: $email_cliente\n\n";
        $mensaje .= "Revisa los detalles en: " . ADMIN_URL;

        mail(ADMIN_EMAIL, $asunto, $mensaje);
    }

    // Enviar email al cliente
    private function enviarEmailCliente($email, $nombre, $estado) {
        $asunto = "Estado de tu pedido - " . TIENDA_NOMBRE;
        $mensaje = "Hola $nombre,\n\n";
        $mensaje .= "El estado de tu pedido ha sido actualizado a: $estado\n\n";
        $mensaje .= "Gracias por tu compra!";

        mail($email, $asunto, $mensaje);
    }
}
?>