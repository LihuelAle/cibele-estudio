<?php
session_start();

require_once dirname(__FILE__) . '/../config/database.php';
require_once dirname(__FILE__) . '/../config/constants.php';
require_once dirname(__FILE__) . '/../app/controllers/ProductoController.php';
require_once dirname(__FILE__) . '/../app/controllers/PedidoController.php';

// Inicializar controladores
$productoCtrl = new ProductoController();
$pedidoCtrl = new PedidoController();

// Obtener página solicitada
$page = isset($_GET['page']) ? $_GET['page'] : 'tienda';

// Carrito en sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Procesar acciones POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    // Agregar al carrito
    if ($action === 'agregar_carrito') {
        $id = (int)$_POST['producto_id'];
        $cantidad = (int)$_POST['cantidad'];
        
        // Validar producto existe
        $producto = $productoCtrl->obtener($id);
        if ($producto) {
            // Verificar si ya está en carrito
            $existe = false;
            foreach ($_SESSION['carrito'] as &$item) {
                if ($item['id'] === $id) {
                    $item['cantidad'] += $cantidad;
                    $existe = true;
                    break;
                }
            }
            
            if (!$existe) {
                $_SESSION['carrito'][] = ['id' => $id, 'cantidad' => $cantidad];
            }
            
            $_SESSION['mensaje'] = 'Producto agregado al carrito';
        }
        header('Location: ' . BASE_URL . '?page=tienda');
        exit;
    }

    // Actualizar carrito
    if ($action === 'actualizar_carrito') {
        $cantidades = isset($_POST['cantidades']) ? $_POST['cantidades'] : [];
        foreach ($_SESSION['carrito'] as &$item) {
            if (isset($cantidades[$item['id']])) {
                $nueva_cantidad = (int)$cantidades[$item['id']];
                if ($nueva_cantidad > 0) {
                    $item['cantidad'] = $nueva_cantidad;
                } else {
                    // Remover si cantidad es 0
                    $item['cantidad'] = 0;
                }
            }
        }
        $_SESSION['carrito'] = array_filter($_SESSION['carrito'], fn($item) => $item['cantidad'] > 0);
        header('Location: ' . BASE_URL . '?page=carrito');
        exit;
    }

    // Crear pedido
    if ($action === 'crear_pedido') {
        if (empty($_SESSION['carrito'])) {
            $_SESSION['error'] = 'El carrito está vacío';
            header('Location: ' . BASE_URL . '?page=carrito');
            exit;
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $nombre = htmlspecialchars($_POST['nombre']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $direccion = htmlspecialchars($_POST['direccion']);

        $resultado = $pedidoCtrl->crearDesdeCarrito($email, $nombre, $telefono, $direccion, $_SESSION['carrito']);
        
        if (isset($resultado['success'])) {
            $_SESSION['mensaje'] = $resultado['success'];
            $_SESSION['carrito'] = [];
            header('Location: ' . BASE_URL . '?page=confirmacion&pedido_id=' . $resultado['pedido_id']);
        } else {
            $_SESSION['error'] = $resultado['error'];
            header('Location: ' . BASE_URL . '?page=carrito');
        }
        exit;
    }

    // Panel Admin - Guardar producto
    if ($action === 'guardar_producto' && isset($_SESSION['admin'])) {
        $resultado = $productoCtrl->guardar(
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['precio'],
            $_POST['cantidad']
        );
        $_SESSION['mensaje'] = $resultado['success'] ?? $resultado['error'];
        header('Location: ' . BASE_URL . '?page=admin&section=productos');
        exit;
    }

    // Panel Admin - Actualizar estado pedido
    if ($action === 'actualizar_estado' && isset($_SESSION['admin'])) {
        $resultado = $pedidoCtrl->actualizarEstado($_POST['pedido_id'], $_POST['estado']);
        $_SESSION['mensaje'] = $resultado['success'] ?? $resultado['error'];
        header('Location: ' . BASE_URL . '?page=admin&section=pedidos');
        exit;
    }
}

switch($page){

    case 'tienda':
        $productos = $productoCtrl->listar();
        require dirname(__FILE__) . '/../app/views/tienda.php';
    break;

    case 'carrito':
        require dirname(__FILE__) . '/../app/views/carrito.php';
    break;

    case 'confirmacion':
        require dirname(__FILE__) . '/../app/views/confirmacion.php';
    break;

    default:
        echo "Página no encontrada";
    break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cibele Estudio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1> funciona? </h1>
    <header>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#cart">Shopping Cart</a></li>
                <li><a href="#admin">Admin Panel</a></li>
                <li><a href="#orders">Order Management</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="products">
            <h1>Product Display</h1>
            <div class="product-list">
                <!-- Product items will be inserted here -->
                <div class="product-item">
                    <h2>Product Name</h2>
                    <p>Description of the product.</p>
                    <button>Add to Cart</button>
                </div>
                <!-- Repeat for more products -->
            </div>
        </section>
        <section id="cart">
            <h1>Your Shopping Cart</h1>
            <!-- Shopping cart items will be displayed here -->
        </section>
        <section id="admin">
            <h1>Admin Panel</h1>
            <p>Manage products and orders here.</p>
        </section>
        <section id="orders">
            <h1>Order Management</h1>
            <p>Manage customer orders here.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2026 Cibele Estudio. All rights reserved.</p>
    </footer>
</body>
</html>
