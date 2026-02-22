<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - Cibele Estudio</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">Cibele Estudio</h1>
            <div class="nav-links">
                <a href="<?php echo BASE_URL; ?>">Tienda</a>
                <a href="<?php echo BASE_URL; ?>?page=carrito">
                    🛒 Carrito (<?php echo count($_SESSION['carrito']); ?>)
                </a>
                <a href="<?php echo BASE_URL; ?>?page=admin">Admin</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
            </div>
        <?php endif; ?>

        <h2>Nuestros Productos</h2>
        <div class="productos-grid">
            <?php foreach ($productos as $producto): ?>
                <div class="producto-card">
                    <?php if ($producto['imagen']): ?>
                        <img src="<?php echo UPLOADS_URL . $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                    <?php else: ?>
                        <div class="imagen-placeholder">Sin imagen</div>
                    <?php endif; ?>
                    
                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    <p class="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                    <p class="stock">Stock: <?php echo $producto['cantidad_disponible']; ?></p>
                    
                    <?php if ($producto['cantidad_disponible'] > 0): ?>
                        <form method="POST" action="<?php echo BASE_URL; ?>">
                            <input type="hidden" name="action" value="agregar_carrito">
                            <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                            <input type="number" name="cantidad" min="1" max="<?php echo $producto['cantidad_disponible']; ?>" value="1">
                            <button type="submit" class="btn-primary">Agregar al Carrito</button>
                        </form>
                    <?php else: ?>
                        <button class="btn-disabled" disabled>Sin Stock</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Cibele Estudio. Todos los derechos reservados.</p>
    </footer>
</body>
</html>