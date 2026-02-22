
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos — Cibele Estudio</title>
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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Nunito', sans-serif; background: var(--cream); color: var(--dark); min-height: 100vh; }

        nav {
            background: var(--sage-dark);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-logo { font-family: 'Caveat', cursive; font-size: 1.5rem; color: white; text-decoration: none; }
        .nav-links { display: flex; gap: 1.5rem; }
        .nav-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            transition: all 0.2s;
        }
        .nav-links a:hover, .nav-links a.active { background: rgba(255,255,255,0.15); color: white; }
        .nav-links a.tienda-link { background: var(--lavender); color: white; }
        .nav-links a.tienda-link:hover { background: #b09ad0; }

        .page-wrap { max-width: 1100px; margin: 2.5rem auto; padding: 0 2rem; }

        .page-title { font-family: 'Caveat', cursive; font-size: 2rem; color: var(--sage-dark); margin-bottom: 0.2rem; }
        .page-sub { font-size: 0.85rem; color: var(--muted); margin-bottom: 2rem; }

        .alert { padding: 0.9rem 1.2rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.88rem; font-weight: 600; }
        .alert-success { background: #edf7ed; border: 1.5px solid #b7ddb7; color: #2a6a2a; }
        .alert-danger  { background: #fdf2f0; border: 1.5px solid #f5c6c6; color: #a04040; }

        /* STATS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 14px;
            padding: 1.2rem 1.4rem;
            text-align: center;
        }
        .stat-emoji { font-size: 1.8rem; margin-bottom: 0.3rem; }
        .stat-num { font-family: 'Caveat', cursive; font-size: 2rem; color: var(--sage-dark); line-height: 1; }
        .stat-label { font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 0.2rem; font-weight: 700; }

        /* CARD */
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

        /* TABLA */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 0.88rem; }
        thead tr { background: var(--cream2); }
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
        td { padding: 0.85rem 1rem; border-bottom: 1px solid var(--border); vertical-align: middle; }
        tbody tr:hover { background: var(--cream); }
        tbody tr:last-child td { border-bottom: none; }

        /* BADGES ESTADO */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-pendiente  { background: #fef9ec; color: #a07020; border: 1px solid #f0d98a; }
        .badge-confirmado { background: var(--lav-pale); color: #8040a0; border: 1px solid var(--lavender); }
        .badge-enviado    { background: #edf0ff; color: #3040a0; border: 1px solid #b0c0f0; }
        .badge-entregado  { background: #edf7ed; color: #2a6a2a; border: 1px solid #b7ddb7; }

        /* SELECT ESTADO */
        .estado-form { display: inline; }
        .estado-select {
            padding: 0.3rem 0.6rem;
            border: 1.5px solid var(--border);
            border-radius: 20px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.8rem;
            color: var(--dark);
            background: white;
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s;
        }
        .estado-select:focus { border-color: var(--lavender); }

        /* DETALLE EXPANDIBLE */
        .btn-ver {
            background: none;
            border: 1.5px solid var(--border);
            color: var(--muted);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-ver:hover { border-color: var(--lavender); color: #8040a0; }

        .detalle-row { display: none; }
        .detalle-row.open { display: table-row; }
        .detalle-cell {
            background: var(--lav-pale);
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.5rem;
        }
        .detalle-inner {
            font-size: 0.85rem;
            color: var(--brown);
            line-height: 2;
        }
        .detalle-inner strong { color: var(--dark); }

        .empty-state { text-align: center; padding: 3rem; color: var(--muted); }
        .empty-state .emoji { font-size: 2.5rem; margin-bottom: 0.5rem; }
        .empty-state p { font-size: 0.88rem; }

        @media (max-width: 600px) {
            nav { padding: 0.8rem 1rem; }
            .nav-links a span { display: none; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<nav>
    <a href="<?php echo BASE_URL; ?>?page=tienda" class="nav-logo">🌿 Cibele Estudio</a>
    <div class="nav-links">
        <a href="<?php echo BASE_URL; ?>?page=admin&section=productos">📦 <span>Productos</span></a>
        <a href="<?php echo BASE_URL; ?>?page=admin&section=pedidos" class="active">📋 <span>Pedidos</span></a>
        <a href="<?php echo BASE_URL; ?>?page=tienda" class="tienda-link">🛍️ <span>Ver Tienda</span></a>
    </div>
</nav>

<div class="page-wrap">

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success">✓ <?php echo htmlspecialchars($_SESSION['mensaje']); unset($_SESSION['mensaje']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">✗ <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="page-title">Gestión de Pedidos 📋</div>
    <p class="page-sub">Revisá y actualizá el estado de cada pedido</p>

    <?php
        $total_pedidos    = count($pedidos);
        $pendientes       = count(array_filter($pedidos, fn($p) => $p['estado'] === 'pendiente'));
        $confirmados      = count(array_filter($pedidos, fn($p) => $p['estado'] === 'confirmado'));
        $entregados       = count(array_filter($pedidos, fn($p) => $p['estado'] === 'entregado'));
        $total_facturado  = array_sum(array_column($pedidos, 'total'));
    ?>

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-emoji">📋</div>
            <div class="stat-num"><?php echo $total_pedidos; ?></div>
            <div class="stat-label">Total pedidos</div>
        </div>
        <div class="stat-card">
            <div class="stat-emoji">⏳</div>
            <div class="stat-num"><?php echo $pendientes; ?></div>
            <div class="stat-label">Pendientes</div>
        </div>
        <div class="stat-card">
            <div class="stat-emoji">💜</div>
            <div class="stat-num"><?php echo $confirmados; ?></div>
            <div class="stat-label">Confirmados</div>
        </div>
        <div class="stat-card">
            <div class="stat-emoji">✅</div>
            <div class="stat-num"><?php echo $entregados; ?></div>
            <div class="stat-label">Entregados</div>
        </div>
        <div class="stat-card">
            <div class="stat-emoji">💰</div>
            <div class="stat-num" style="font-size:1.4rem;">$<?php echo number_format($total_facturado, 0); ?></div>
            <div class="stat-label">Facturado</div>
        </div>
    </div>

    <!-- TABLA -->
    <div class="card">
        <div class="card-title">📬 Todos los pedidos</div>

        <?php if (empty($pedidos)): ?>
            <div class="empty-state">
                <div class="emoji">🌸</div>
                <p>Todavía no hay pedidos. ¡Cuando lleguen los verás acá!</p>
            </div>
        <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Contacto</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><strong style="color:var(--muted);">#<?php echo $pedido['id']; ?></strong></td>
                        <td><strong><?php echo htmlspecialchars($pedido['nombre_cliente']); ?></strong></td>
                        <td>
                            <div style="font-size:0.82rem;">
                                <?php if ($pedido['email_cliente'] && $pedido['email_cliente'] !== 'sin-email@cibele.com'): ?>
                                    <div>📧 <?php echo htmlspecialchars($pedido['email_cliente']); ?></div>
                                <?php endif; ?>
                                <?php if ($pedido['telefono']): ?>
                                    <div>📱 <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $pedido['telefono']); ?>" target="_blank" style="color:var(--sage);text-decoration:none;font-weight:700;"><?php echo htmlspecialchars($pedido['telefono']); ?></a></div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <span style="font-family:'Caveat',cursive;font-size:1.2rem;color:var(--sage);">
                                $<?php echo number_format($pedido['total'], 2); ?>
                            </span>
                        </td>
                        <td>
                            <form method="POST" action="<?php echo BASE_URL; ?>" class="estado-form">
                                <input type="hidden" name="action" value="actualizar_estado">
                                <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
                                <select name="estado" class="estado-select" onchange="this.form.submit()">
                                    <option value="pendiente"  <?php echo $pedido['estado'] === 'pendiente'  ? 'selected' : ''; ?>>⏳ Pendiente</option>
                                    <option value="confirmado" <?php echo $pedido['estado'] === 'confirmado' ? 'selected' : ''; ?>>💜 Confirmado</option>
                                    <option value="enviado"    <?php echo $pedido['estado'] === 'enviado'    ? 'selected' : ''; ?>>📦 Enviado</option>
                                    <option value="entregado"  <?php echo $pedido['estado'] === 'entregado'  ? 'selected' : ''; ?>>✅ Entregado</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size:0.82rem;color:var(--muted);">
                            <?php echo date('d/m/Y', strtotime($pedido['creado_en'])); ?><br>
                            <span style="font-size:0.75rem;"><?php echo date('H:i', strtotime($pedido['creado_en'])); ?></span>
                        </td>
                        <td>
                            <button class="btn-ver" onclick="toggleDetalle(<?php echo $pedido['id']; ?>)">
                                Ver más
                            </button>
                        </td>
                    </tr>
                    <!-- FILA DETALLE -->
                    <tr class="detalle-row" id="detalle-<?php echo $pedido['id']; ?>">
                        <td colspan="7" class="detalle-cell">
                            <div class="detalle-inner">
                                <?php if ($pedido['direccion']): ?>
                                    <div>📍 <strong>Dirección:</strong> <?php echo nl2br(htmlspecialchars($pedido['direccion'])); ?></div>
                                <?php endif; ?>
                                <div>🗓 <strong>Pedido el:</strong> <?php echo date('d/m/Y \a \l\a\s H:i', strtotime($pedido['creado_en'])); ?></div>
                            </div>
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
function toggleDetalle(id) {
    const row = document.getElementById('detalle-' + id);
    row.classList.toggle('open');
}
</script>

</body>
</html>