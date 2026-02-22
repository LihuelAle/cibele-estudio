<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Productos - Cibele Estudio</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">Cibele Estudio - Admin</h1>
            <div class="nav-links">
                <a href="<?php echo BASE_URL; ?>">Tienda</a>
                <a href="<?php echo BASE_URL; ?>?page=admin&section=productos">Productos</a>
                <a href="<?php echo BASE_URL; ?>?page=admin&section=pedidos">Pedidos</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
            </div>
        <?php endif; ?>

        <h2>Administrar Productos</h2>

        <form method="POST" action="<?php echo BASE_URL; ?>" enctype="multipart/form-data" class="formulario">
            <input type="hidden" name="action" value="guardar_producto">
            
            <h3>Agregar Nuevo Producto</h3>
            
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad Disponible:</label>
                <input type="number" id="cantidad" name="cantidad" required>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen del Producto:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
            </div>

            <button type="submit" class="btn-primary">Agregar Producto</button>
        </form>

        <h3>Productos Existentes</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['id']; ?></td>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                        <td><?php echo $producto['cantidad_disponible']; ?></td>
                        <td><?php echo $producto['activo'] ? '✓' : '✗'; ?></td>
                        <td>
                            <a href="#" class="btn-small">Editar</a>
                            <a href="#" class="btn-small btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Cibele Estudio. Todos los derechos reservados.</p>
    </footer>
</body>
</html>