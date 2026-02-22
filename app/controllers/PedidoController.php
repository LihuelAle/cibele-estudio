<?php
require_once dirname(__FILE__) . '/../models/Pedido.php';
require_once dirname(__FILE__) . '/../models/Producto.php';

class ProductoController {
    private $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    // Mostrar todos los productos
    public function listar() {
        return $this->producto->obtenerTodos();
    }

    // Obtener un producto
    public function obtener($id) {
        return $this->producto->obtenerPorId($id);
    }

    // Guardar nuevo producto
    public function guardar($nombre, $descripcion, $precio, $cantidad) {
        // Validar datos
        if (empty($nombre) || empty($precio)) {
            return ['error' => 'Nombre y precio son requeridos'];
        }

        // Manejar subida de imagen
        $imagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
            $imagen = $this->subirImagen($_FILES['imagen']);
        }

        if ($this->producto->crear($nombre, $descripcion, $precio, $imagen, $cantidad)) {
            return ['success' => 'Producto creado exitosamente'];
        }
        return ['error' => 'Error al crear el producto'];
    }

    // Actualizar producto
    public function actualizar($id, $nombre, $descripcion, $precio, $cantidad, $activo) {
        $productoActual = $this->producto->obtenerPorId($id);
        $imagen = $productoActual['imagen'];

        if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
            if ($imagen && file_exists(UPLOAD_PATH . $imagen)) {
                unlink(UPLOAD_PATH . $imagen);
            }
            $imagen = $this->subirImagen($_FILES['imagen']);
        }

        if ($this->producto->actualizar($id, $nombre, $descripcion, $precio, $imagen, $cantidad, $activo)) {
            return ['success' => 'Producto actualizado exitosamente'];
        }
        return ['error' => 'Error al actualizar el producto'];
    }

    // Eliminar producto
    public function eliminar($id) {
        if ($this->producto->eliminar($id)) {
            return ['success' => 'Producto eliminado exitosamente'];
        }
        return ['error' => 'Error al eliminar el producto'];
    }

    // Buscar productos
    public function buscar($termino) {
        return $this->producto->buscar($termino);
    }

    // Subir imagen
    private function subirImagen($file) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $extensiones = ['jpg', 'jpeg', 'png', 'gif'];
        $archivo = basename($file['name']);
        $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

        if (!in_array($ext, $extensiones)) {
            return null;
        }

        $nombre_archivo = uniqid() . '.' . $ext;
        $ruta_destino = UPLOAD_PATH . $nombre_archivo;

        if (!is_dir(UPLOAD_PATH)) {
            mkdir(UPLOAD_PATH, 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $ruta_destino)) {
            return $nombre_archivo;
        }
        return null;
    }
}
?>