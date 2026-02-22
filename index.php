<?php

session_start();

require_once dirname(__FILE__) . '/../config/database.php';
require_once dirname(__FILE__) . '/../config/constants.php';
require_once dirname(__FILE__) . '/../app/controllers/ProductoController.php';
require_once dirname(__FILE__) . '/../app/controllers/PedidoController.php';

$productoCtrl = new ProductoController();
$pedidoCtrl   = new PedidoController();

$page = $_GET['page'] ?? 'tienda';

// ===================================================
// PROCESAR ACCIONES POST
// ===================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    // ---------------- CREAR PEDIDO ----------------
    if ($action === 'crear_pedido') {
        $nombre    = htmlspecialchars(trim($_POST['nombre'] ?? ''));
        $apellido  = htmlspecialchars(trim($_POST['apellido'] ?? ''));
        $telefono  = htmlspecialchars(trim($_POST['telefono'] ?? ''));
        $email     = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $direccion = htmlspecialchars(trim($_POST['direccion'] ?? ''));
        $comentarios = htmlspecialchars(trim($_POST['comentarios'] ?? ''));
        $ids_raw   = $_POST['productos_ids'] ?? '';

        // Parsear IDs de productos seleccionados
        $ids = array_filter(array_map('intval', explode(',', $ids_raw)));

        if (empty($ids)) {
            $_SESSION['error'] = 'Seleccioná al menos un producto';
            header('Location: ' . BASE_URL);
            exit;
        }

        if (empty($nombre) || empty($telefono)) {
            $_SESSION['error'] = 'Nombre y teléfono son obligatorios';
            header('Location: ' . BASE_URL);
            exit;
        }

        // Construir carrito simple con cantidad 1 por producto
        $carrito = array_map(fn($id) => ['id' => $id, 'cantidad' => 1], $ids);

        $nombre_completo = $apellido ? "$nombre $apellido" : $nombre;

        // Agregar comentarios a la dirección si no hay dirección
        $dir_final = $direccion;
        if ($comentarios) {
            $dir_final .= $dir_final ? "\n\nComentarios: $comentarios" : "Comentarios: $comentarios";
        }

        $resultado = $pedidoCtrl->crearDesdeCarrito(
            $email ?: 'sin-email@cibele.com',
            $nombre_completo,
            $telefono,
            $dir_final,
            $carrito
        );

        if (isset($resultado['success'])) {
            header('Location: ' . BASE_URL . '?page=confirmacion&pedido_id=' . $resultado['pedido_id']);
        } else {
            $_SESSION['error'] = $resultado['error'];
            header('Location: ' . BASE_URL);
        }
        exit;
    }

    // ---------------- ADMIN: GUARDAR PRODUCTO ----------------
    if ($action === 'guardar_producto') {
        $resultado = $productoCtrl->guardar(
            $_POST['nombre'] ?? '',
            $_POST['descripcion'] ?? '',
            $_POST['precio'] ?? 0,
            $_POST['cantidad'] ?? 0
        );
        $_SESSION['mensaje'] = $resultado['success'] ?? $resultado['error'];
        header('Location: ' . BASE_URL . '?page=admin&section=productos');
        exit;
    }

    // ---------------- ADMIN: ACTUALIZAR ESTADO PEDIDO ----------------
    if ($action === 'actualizar_estado') {
        $resultado = $pedidoCtrl->actualizarEstado($_POST['pedido_id'], $_POST['estado']);
        $_SESSION['mensaje'] = $resultado['success'] ?? $resultado['error'];
        header('Location: ' . BASE_URL . '?page=admin&section=pedidos');
        exit;
    }

    // ---------------- ADMIN: ELIMINAR PRODUCTO ----------------
    if ($action === 'eliminar_producto') {
        $resultado = $productoCtrl->eliminar((int)$_POST['producto_id']);
        $_SESSION['mensaje'] = $resultado['success'] ?? $resultado['error'];
        header('Location: ' . BASE_URL . '?page=admin&section=productos');
        exit;
    }
}

// ===================================================
// ROUTING
// ===================================================
switch ($page) {

    case 'admin':
    $section = $_GET['section'] ?? 'productos';
    if ($section === 'pedidos') {
        $pedidos = $pedidoCtrl->listar();
        require dirname(__FILE__) . '/../app/views/admin_pedidos.php';
    } else {
        $productos = $productoCtrl->listar();
        require dirname(__FILE__) . '/../app/views/admin_productos.php';
    }
    break;

    case 'tienda':
        $productos = $productoCtrl->listar();
        require dirname(__FILE__) . '/../app/views/tienda.php';
        break;

    case 'confirmacion':
        $pedido_id = (int)($_GET['pedido_id'] ?? 0);
        $pedido = $pedido_id ? $pedidoCtrl->obtener($pedido_id) : null;
        require dirname(__FILE__) . '/../app/views/confirmacion.php';
        break;

    default:
        header('Location: ' . BASE_URL . '?page=tienda');
        exit;
        require_once __DIR__ . '/../config/config.php';

echo BASE_URL;
exit;
}
?>