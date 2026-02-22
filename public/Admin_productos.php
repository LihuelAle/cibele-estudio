<?php
require_once __DIR__ . '/../config/config.php';

/* DEBUG PROVISORIO */
echo "<pre>";
var_dump($productos ?? 'NO EXISTE $productos');
echo "</pre>";?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Cibele Estudio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #f5f0e6;
            --cream2: #ede8da;
            --lavender: #c8b4e0;
            --lav-soft: #e8dff5;
            --lav-pale: #f3eefb;
            --sage: #7a9468;
            --sage-dark: #5a7050;
            --brown: #5c4a2a;
            --muted: #8a7d6a;
            --border: #d8cfc0;
            --dark: #2e2416;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--cream);
            color: var(--dark);
            min-height: 100vh;
        }

        /* NAV */
        nav {
            background: var(--sage-dark);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            font-family: 'Caveat', cursive;
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            transition: all 0.2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .nav-links a.tienda-link {
            background: var(--lavender);
            color: white;
        }

        .nav-links a.tienda-link:hover {
            background: #b09ad0;
        }

        /* LAYOUT */
        .page-wrap {
            max-width: 1000px;
            margin: 2.5rem auto;
            padding: 0 2rem;
        }

        .page-title {
            font-family: 'Caveat', cursive;
            font-size: 2rem;
            color: var(--sage-dark);
            margin-bottom: 0.2rem;
        }

        .page-sub {
            font-size: 0.85rem;
            color: var(--muted);
            margin-bottom: 2rem;
        }

        /* ALERTAS */
        .alert {
            padding: 0.9rem 1.2rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.88rem;
            font-weight: 600;
        }

        .alert-success {
            background: #edf7ed;
            border: 1.5px solid #b7ddb7;
            color: #2a6a2a;
        }

        .alert-danger {
            background: #fdf2f0;
            border: 1.5px solid #f5c6c6;
            color: #a04040;
        }

        /* FORM CARD */
        .card {
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 1.8rem;
            margin-bottom: 2rem;
        }

        .card-title {
            font-family: 'Caveat', cursive;
            font-size: 1.4rem;
            color: var(--brown);
            margin-bottom: 1.4rem;
            padding-bottom: 0.8rem;
            border-bottom: 1.5px solid var(--border);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-full {
            grid-column: 1 / -1;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-group label {
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 0.65rem 0.9rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.9rem;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s;
            background: white;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--lavender);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .file-input-wrap {
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .file-input-wrap:hover {
            border-color: var(--lavender);
        }

        .file-input-wrap input {
            display: none;
        }

        .btn-primary {
            background: var(--sage-dark);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background: var(--lavender);
            transform: scale(1.02);
        }

        /* TABLA */
        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88rem;
        }

        thead tr {
            background: var(--cream2);
        }

        th {
            padding: 0.8rem 1rem;
            text-align: left;
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
            border-bottom: 1.5px solid var(--border);
        }

        td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border);
            color: var(--dark);
            vertical-align: middle;
        }

        tbody tr:hover {
            background: var(--cream);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .badge-ok {
            background: #edf7ed;
            color: #3a7a3a;
            border: 1px solid #b7ddb7;
        }

        .badge-no {
            background: #fdf2f0;
            color: #a04040;
            border: 1px solid #f5c6c6;
        }

        .badge-activo {
            background: var(--lav-pale);
            color: #8040a0;
            border: 1px solid var(--lavender);
        }

        .badge-inactivo {
            background: var(--cream2);
            color: var(--muted);
            border: 1px solid var(--border);
        }

        .btn-del {
            background: none;
            border: 1.5px solid #f5c6c6;
            color: #a04040;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-del:hover {
            background: #fdf2f0;
            border-color: #a04040;
        }

        .prod-thumb {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
        }

        .no-thumb {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: var(--lav-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            border: 1px solid var(--border);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--muted);
        }

        .empty-state .emoji {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            font-size: 0.88rem;
        }

        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .nav-links a span {
                display: none;
            }

            nav {
                padding: 0.8rem 1rem;
            }
        }
    </style>
</head>

<body>

<nav>
    <a href="/cibele_studio/public/index.php" class="nav-logo">
        🌿 Cibele Estudio
    </a>

    <div class="nav-links">
        <a href="<?php echo BASE_URL; ?>?page=admin&section=productos">
            📦 <span>Productos</span>
        </a>
        <a href="http://localhost/cibele_studio/app/views/admin_pedidos.php">
            📋 <span>Pedidos</span>
        </a>
        <a href="<?php echo BASE_URL; ?>?page=tienda" class="tienda-link">
            🛍️ <span>Ver Tienda</span>
        </a>
    </div>
</nav>

<div class="page-wrap">

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success">
            ✓ <?php echo htmlspecialchars($_SESSION['mensaje']); unset($_SESSION['mensaje']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            ✗ <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="page-title">Gestión de Productos 📦</div>
    <p class="page-sub">Agregá, editá o eliminá productos de la tienda</p>

    <!-- FORMULARIO AGREGAR -->
    <div class="card">
        <div class="card-title">➕ Agregar nuevo producto</div>

        <form method="POST" action="<?php echo BASE_URL; ?>" enctype="multipart/form-data">
            <input type="hidden" name="action" value="guardar_producto">

            <div class="form-grid">

                <div class="form-group">
                    <label>Nombre del producto *</label>
                    <input type="text" name="nombre" placeholder="Ej: Pulsera de macramé" required>
                </div>

                <div class="form-group">
                    <label>Precio *</label>
                    <input type="number" name="precio" step="0.01" min="0" placeholder="0.00" required>
                </div>

                <div class="form-group form-full">
                    <label>Descripción</label>
                    <textarea name="descripcion" placeholder="Descripción del producto..."></textarea>
                </div>

                <div class="form-group">
                    <label>Cantidad disponible *</label>
                    <input type="number" name="cantidad" min="0" placeholder="0" required>
                </div>

                <div class="form-group">
                    <label>Imagen</label>
                    <label class="file-input-wrap" id="fileLabel">
                        📷 Hacer click para subir imagen
                        <input type="file" name="imagen" accept="image/*" onchange="updateLabel(this)">
                    </label>
                </div>

            </div>

            <button type="submit" class="btn-primary">✨ Agregar Producto</button>
        </form>
    </div>

    <!-- TABLA PRODUCTOS -->
    <div class="card">
        <div class="card-title">
            📋 Productos existentes (<?php echo count($productos); ?>)
        </div>

        <?php if (empty($productos)): ?>
            <div class="empty-state">
                <div class="emoji">🌸</div>
                <p>Todavía no hay productos. ¡Agregá el primero!</p>
            </div>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($productos as $p): ?>
                            <tr>
                                <td>
                                    <?php if ($p['imagen']): ?>
                                        <img class="prod-thumb"
                                             src="<?php echo UPLOADS_URL . htmlspecialchars($p['imagen']); ?>"
                                             alt="">
                                    <?php else: ?>
                                        <div class="no-thumb">🌸</div>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <strong><?php echo htmlspecialchars($p['nombre']); ?></strong><br>
                                    <span style="font-size:0.78rem;color:var(--muted);">
                                        <?php echo mb_strimwidth(htmlspecialchars($p['descripcion']), 0, 50, '...'); ?>
                                    </span>
                                </td>

                                <td>
                                    <span style="font-family:'Caveat',cursive;font-size:1.2rem;color:var(--sage);">
                                        $<?php echo number_format($p['precio'], 2); ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="badge <?php echo $p['cantidad_disponible'] > 0 ? 'badge-ok' : 'badge-no'; ?>">
                                        <?php echo $p['cantidad_disponible']; ?> unid.
                                    </span>
                                </td>

                                <td>
                                    <span class="badge <?php echo $p['activo'] ? 'badge-activo' : 'badge-inactivo'; ?>">
                                        <?php echo $p['activo'] ? '✓ Activo' : '✗ Inactivo'; ?>
                                    </span>
                                </td>

                                <td>
                                    <form method="POST"
                                          action="<?php echo BASE_URL; ?>"
                                          onsubmit="return confirm('¿Eliminar este producto?')">
                                        <input type="hidden" name="action" value="eliminar_producto">
                                        <input type="hidden" name="producto_id" value="<?php echo $p['id']; ?>">
                                        <button type="submit" class="btn-del">🗑 Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
    function updateLabel(input) {
        const label = document.getElementById('fileLabel');
        if (input.files && input.files[0]) {
            label.textContent = '✓ ' + input.files[0].name;
        }
    }
</script>

</body>
</html>