<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - Cibele Estudio</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">Cibele Estudio</h1>
            <div class="nav-links">
                <a href="<?php echo BASE_URL; ?>">Tienda</a>
                <a href="<?php echo BASE_URL; ?>?page=carrito">🛒 Carrito</a>
                <a href="<?php echo BASE_URL; ?>?page=admin">Admin</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Mi Carrito de Compras</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Tu carrito está vacío. <a href="<?php echo BASE_URL; ?>">Volver a tienda</a></p>
        <?php else: ?>
            <form method="POST" action="<?php echo BASE_URL; ?>" class="carrito-form">
                <input type="hidden" name="action" value="actualizar_carrito">
                <table class="carrito-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $productoCtrl = new ProductoController();
                        $total_general = 0;
                        
                        foreach ($_SESSION['carrito'] as $item):
                            $producto = $productoCtrl->obtener($item['id']);
                            $subtotal = $producto['precio'] * $item['cantidad'];
                            $total_general += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                                <td>
                                    <input type="number" 
                                           name="cantidades[<?php echo $producto['id']; ?>]" 
                                           min="0" 
                                           max="<?php echo $producto['cantidad_disponible']; ?>" 
                                           value="<?php echo $item['cantidad']; ?>"
                                           class="cantidad-input">
                                </td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn-secondary">Actualizar Carrito</button>
            </form>

            <div class="carrito-resumen">
                <h3>Total: $<?php echo number_format($total_general, 2); ?></h3>
                <a href="<?php echo BASE_URL; ?>" class="btn-secondary">Seguir Comprando</a>
            </div>

            <h3>Datos de Envío</h3>
            <form method="POST" action="<?php echo BASE_URL; ?>" class="formulario">
                <input type="hidden" name="action" value="crear_pedido">
                
                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección de Envío:</label>
                    <textarea id="direccion" name="direccion" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn-primary">Completar Compra</button>
            </form>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 Cibele Estudio. Todos los derechos reservados.</p>
    </footer>
</body>
</html>