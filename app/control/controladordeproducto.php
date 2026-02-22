<?php
// app/controllers/ProductoController.php
require_once __DIR__ . '/../modelo/Producto.php';

class ProductoController {
    private $productoModel;

    public function __construct($conn) {
        $this->productoModel = new Producto($conn);
    }

    public function mostrarProductos() {
        return $this->productoModel->obtenerTodos();
    }
}
?>