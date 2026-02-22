<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pedidos - Cibele Estudio</title>
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

        <h2>Administrar Pedidos</h2>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td>#<?php echo $pedido['id']; ?></td>
                        <td><?php echo htmlspecialchars($pedido['nombre_cliente']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['email_cliente']); ?></td>
                        <td>$<?php echo number_format($pedido['total'], 2); ?></td>
                        <td>
                            <form method="POST" action="<?php echo BASE_URL; ?>" class="estado-form">
                                <input type="hidden" name="action" value="actualizar_estado">
                                <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
                                <select name="estado" onchange="this.form.submit()">
                                    <option value="pendiente" <?php echo $pedido['estado'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                    <option value="confirmado" <?php echo $pedido['estado'] === 'confirmado' ? 'selected' : ''; ?>>Confirmado</option>
                                    <option value="enviado" <?php echo $pedido['estado'] === 'enviado' ? 'selected' : ''; ?>>Enviado</option>
                                    <option value="entregado" <?php echo $pedido['estado'] === 'entregado' ? 'selected' : ''; ?>>Entregado</option>
                                </select>
                            </form>
                        </td>
                        <td><?php echo date('d/m/Y H:i', strtotime($pedido['creado_en'])); ?></td>
                        <td>
                            <a href="#" class="btn-small">Ver Detalles</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Cibele Estudio. Todos los derechos reservados.</p>
    </footer>
    
    <style>
        .estado-form {
            display: inline;
        }
        .estado-form select {
            padding: 5px;
        }
    </style>
</body>
</html>