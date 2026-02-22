<?php
require_once __DIR__ . "/../modelo/Producto.php";

class ControladorDeProducto {
    private $modelo;

    public function __construct($conn) {
        $this->modelo = new Producto($conn);
    }

    public function mostrarProductos() {
        return $this->modelo->obtenerTodos();
    }

    public function insertarProducto($nombre, $descripcion, $precio, $imagen = null) {
        return $this->modelo->insertar($nombre, $descripcion, $precio, $imagen);
    }

    public function eliminarProducto($id) {
        return $this->modelo->eliminar($id);
    }

    public function obtenerProducto($id) {
        return $this->modelo->obtenerPorId($id);
    }

    public function actualizarProducto($id, $nombre, $descripcion, $precio, $imagen = null) {
        return $this->modelo->actualizar($id, $nombre, $descripcion, $precio, $imagen);
    }
}
?>