<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cibele Estudio — Manualidades y artesanías</title>
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
        body { font-family: 'Nunito', sans-serif; background: var(--cream); color: var(--dark); }

        /* NAV */
        nav {
            background: var(--cream);
            border-bottom: 1.5px solid var(--border);
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo-nav {
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .logo-img {
            height: 50px;
            width: auto;
            object-fit: contain;}
             .logo-img2 {
            height: 300px;
            width: auto;
            object-fit: contain;
        }
        /* Fallback si no hay imagen */
        .logo-texto {
            font-family: 'Caveat', cursive;
            font-size: 1.8rem;
            color: var(--sage-dark);
        }
        .nav-links { display: flex; gap: 1.8rem; align-items: center; }
        .nav-links a { font-size: 0.85rem; color: var(--muted); text-decoration: none; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover { color: var(--sage); }
        .nav-links .btn-contacto {
            background: var(--lav-soft);
            color: #8040a0;
            border: 1.5px solid var(--lavender);
            padding: 0.4rem 1.1rem;
            border-radius: 30px;
            font-weight: 700;
            transition: all 0.2s;
        }
        .nav-links .btn-contacto:hover { background: var(--lavender); color: white; }

        /* HERO */
        .hero {
            text-align: center;
            padding: 4rem 2rem 3rem;
            background: linear-gradient(180deg, var(--cream) 0%, var(--lav-pale) 100%);
            position: relative;
            overflow: hidden;
        }
        .hero::before, .hero::after { content: '🌿'; position: absolute; font-size: 4rem; opacity: 0.15; }
        .hero::before { top: 20px; left: 5%; transform: rotate(-20deg); }
        .hero::after  { top: 20px; right: 5%; transform: rotate(20deg) scaleX(-1); }
        .hero-tag {
            display: inline-block;
            background: var(--lav-soft);
            color: #8040a0;
            border: 1.5px solid var(--lavender);
            border-radius: 30px;
            font-size: 0.75rem;
            padding: 0.3rem 1rem;
            letter-spacing: 0.06em;
            margin-bottom: 1.2rem;
            font-weight: 700;
        }
        .hero h1 { font-family: 'Caveat', cursive; font-size: clamp(2.8rem, 7vw, 4.5rem); color: var(--sage-dark); line-height: 1.1; margin-bottom: 0.5rem; }
        .hero-sub { font-size: 1rem; color: var(--muted); margin-bottom: 1rem; font-weight: 300; }
        .hero-desc { font-size: 0.92rem; color: var(--muted); max-width: 440px; margin: 0 auto; line-height: 1.8; }
        .hero-badges { display: flex; justify-content: center; gap: 1.2rem; margin-top: 1.8rem; flex-wrap: wrap; }
        .hero-badge { font-size: 0.8rem; color: var(--sage); font-weight: 600; }

        /* PRODUCTOS */
        .section-wrap { padding: 3rem 2rem 7rem; max-width: 1100px; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 2.5rem; }
        .section-header h2 { font-family: 'Caveat', cursive; font-size: 2.2rem; color: var(--sage-dark); margin-bottom: 0.3rem; }
        .section-header p { font-size: 0.85rem; color: var(--muted); }
        .dot-divider { display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin: 0.8rem 0 2.5rem; color: var(--lavender); font-size: 0.8rem; letter-spacing: 0.3em; }

        .productos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.4rem; }

        .producto-card {
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            transition: transform 0.25s, box-shadow 0.25s, border-color 0.2s;
            user-select: none;
        }
        .producto-card:hover { transform: translateY(-4px); box-shadow: 0 10px 32px rgba(120,100,70,0.12); }
        .producto-card.seleccionado { border-color: var(--lavender); box-shadow: 0 0 0 3px var(--lav-soft); }

        .check-badge {
            position: absolute; top: 10px; right: 10px;
            width: 30px; height: 30px;
            background: var(--lavender);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 0.9rem;
            opacity: 0; transform: scale(0.3) rotate(-30deg);
            transition: opacity 0.2s, transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
            z-index: 2;
        }
        .producto-card.seleccionado .check-badge { opacity: 1; transform: scale(1) rotate(0); }

        .producto-img { width: 100%; height: 220px; object-fit: cover; display: block; transition: transform 0.4s ease; }
        .producto-card:hover .producto-img { transform: scale(1.04); }

        .imagen-placeholder {
            width: 100%; height: 220px;
            background: linear-gradient(135deg, var(--lav-pale), var(--cream2));
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 0.5rem; color: var(--lavender); font-size: 2.5rem;
        }
        .imagen-placeholder span { font-size: 0.72rem; color: var(--muted); letter-spacing: 0.1em; }

        .producto-info { padding: 1.1rem 1.3rem 1.3rem; }
        .producto-info h3 { font-family: 'Caveat', cursive; font-size: 1.3rem; color: var(--brown); margin-bottom: 0.3rem; }
        .producto-desc { font-size: 0.82rem; color: var(--muted); line-height: 1.6; margin-bottom: 0.9rem; font-weight: 300; }
        .producto-footer { display: flex; justify-content: space-between; align-items: center; }
        .precio { font-family: 'Caveat', cursive; font-size: 1.5rem; color: var(--sage); }
        .stock-pill { font-size: 0.7rem; padding: 0.22rem 0.7rem; border-radius: 30px; font-weight: 700; }
        .stock-ok { background: #edf7ed; color: #3a7a3a; border: 1px solid #b7ddb7; }
        .stock-no { background: #fdf2f0; color: #a04040; border: 1px solid #f5c6c6; }
        .agotado-overlay {
            position: absolute; inset: 0;
            background: rgba(245,240,230,0.75);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Caveat', cursive; font-size: 1.3rem; color: var(--muted);
            cursor: default;
        }

        /* BARRA */
        .seleccion-bar {
            position: fixed; bottom: 0; left: 0; right: 0;
            background: var(--sage-dark);
            padding: 1rem 2rem;
            display: flex; justify-content: space-between; align-items: center;
            transform: translateY(100%);
            transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
            z-index: 200;
            box-shadow: 0 -4px 30px rgba(0,0,0,0.15);
        }
        .seleccion-bar.visible { transform: translateY(0); }
        .bar-info { color: rgba(255,255,255,0.8); font-size: 0.85rem; }
        .bar-info strong { color: white; font-family: 'Caveat', cursive; font-size: 1.2rem; }
        .bar-nombres { font-size: 0.75rem; color: rgba(255,255,255,0.5); margin-top: 2px; }
        .btn-pedir {
            background: var(--lavender); color: white; border: none;
            padding: 0.7rem 2rem; border-radius: 30px;
            font-family: 'Nunito', sans-serif; font-size: 0.88rem; font-weight: 700;
            cursor: pointer; transition: background 0.2s, transform 0.15s; white-space: nowrap;
        }
        .btn-pedir:hover { background: #b09ad0; transform: scale(1.03); }

        /* MODALES */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(46,36,22,0.5);
            z-index: 300;
            display: none; align-items: center; justify-content: center;
            padding: 1rem;
            backdrop-filter: blur(4px);
        }
        .modal-overlay.open { display: flex; }
        .modal {
            background: var(--cream); width: 100%; max-width: 540px;
            max-height: 92vh; overflow-y: auto;
            border-radius: 20px; padding: 2.2rem; position: relative;
            animation: popIn 0.3s cubic-bezier(0.34,1.56,0.64,1);
            border: 1.5px solid var(--border);
        }
        @keyframes popIn {
            from { opacity: 0; transform: scale(0.92) translateY(20px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-close {
            position: absolute; top: 1rem; right: 1.2rem;
            background: var(--cream2); border: none; width: 30px; height: 30px;
            border-radius: 50%; font-size: 1.1rem; cursor: pointer; color: var(--muted);
            display: flex; align-items: center; justify-content: center; transition: background 0.2s;
        }
        .modal-close:hover { background: var(--border); }
        .modal-title { font-family: 'Caveat', cursive; font-size: 2rem; color: var(--sage-dark); margin-bottom: 0.2rem; }
        .modal-sub { font-size: 0.82rem; color: var(--muted); margin-bottom: 1.5rem; }

        .resumen-box { background: var(--lav-pale); border: 1.5px solid var(--lavender); border-radius: 12px; padding: 1rem 1.2rem; margin-bottom: 1.5rem; }
        .resumen-label { font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase; color: #8040a0; font-weight: 700; margin-bottom: 0.7rem; display: block; }
        .resumen-item { display: flex; justify-content: space-between; font-size: 0.88rem; padding: 0.35rem 0; border-bottom: 1px solid rgba(200,180,224,0.3); color: var(--brown); }
        .resumen-item:last-child { border-bottom: none; }
        .resumen-precio { font-family: 'Caveat', cursive; font-size: 1.1rem; color: var(--sage); }

        .form-group { margin-bottom: 1.1rem; }
        .form-group label { display: block; font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted); margin-bottom: 0.4rem; font-weight: 700; }
        .form-group input, .form-group textarea {
            width: 100%; padding: 0.7rem 0.9rem;
            border: 1.5px solid var(--border); background: white; border-radius: 10px;
            font-family: 'Nunito', sans-serif; font-size: 0.9rem; color: var(--dark);
            outline: none; transition: border-color 0.2s;
        }
        .form-group input:focus, .form-group textarea:focus { border-color: var(--lavender); }
        .form-group textarea { resize: vertical; min-height: 75px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem; }
        .btn-submit {
            width: 100%; padding: 0.9rem;
            background: var(--sage-dark); color: white; border: none; border-radius: 30px;
            font-family: 'Nunito', sans-serif; font-size: 0.9rem; font-weight: 700;
            cursor: pointer; transition: background 0.2s, transform 0.15s; margin-top: 0.5rem;
        }
        .btn-submit:hover { background: var(--lavender); transform: scale(1.01); }

        /* CONTACTO */
        .contacto-modal { text-align: center; padding: 0.5rem 0; }
        .contacto-links { display: flex; flex-direction: column; gap: 1rem; margin-top: 1.5rem; }
        .contacto-btn {
            display: flex; align-items: center; gap: 1rem;
            padding: 1rem 1.5rem; border-radius: 14px; text-decoration: none;
            font-weight: 700; font-size: 0.95rem; transition: transform 0.2s, box-shadow 0.2s;
        }
        .contacto-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
        .contacto-btn-ig { background: linear-gradient(135deg, #f5e8ff, #ffe0f0); border: 1.5px solid #e0b4f0; color: #8040a0; }
        .contacto-btn-wa { background: linear-gradient(135deg, #e8f8ee, #d4f0dc); border: 1.5px solid #90d4a8; color: #2a7a4a; }
        .contacto-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
        .contacto-icon-ig { background: #e8d0f8; }
        .contacto-icon-wa { background: #c8ecd8; }
        .contacto-btn-text { text-align: left; }
        .contacto-btn-label { font-size: 0.72rem; opacity: 0.7; font-weight: 400; }
        .contacto-btn-value { font-size: 1rem; font-weight: 700; }
        .contacto-note { font-size: 0.8rem; color: var(--muted); margin-top: 1.5rem; line-height: 1.6; }

        /* FOOTER */
        footer { border-top: 1.5px solid var(--border); padding: 2.5rem 2rem; text-align: center; background: var(--cream2); }
        .footer-logo { font-family: 'Caveat', cursive; font-size: 1.8rem; color: var(--sage-dark); margin-bottom: 0.4rem; }
        footer p { font-size: 0.8rem; color: var(--muted); }
        .footer-social { display: flex; justify-content: center; gap: 1.5rem; margin-top: 0.8rem; }
        .footer-social a { font-size: 0.82rem; color: #8040a0; text-decoration: none; font-weight: 700; }

        /* ALERT */
        .alert-wrap { max-width: 700px; margin: 1rem auto; padding: 0 2rem; }
        .alert { padding: 0.9rem 1.2rem; border-radius: 10px; font-size: 0.88rem; }
        .alert-danger { background: #fdf2f0; border: 1.5px solid #f5c6c6; color: #a04040; }

        @media (max-width: 600px) {
            .hero h1 { font-size: 2.8rem; }
            .form-row { grid-template-columns: 1fr; }
            .productos-grid { grid-template-columns: 1fr; }
            .seleccion-bar { flex-direction: column; gap: 0.8rem; text-align: center; }
            nav { padding: 0.8rem 1rem; }
            .section-wrap { padding: 2rem 1rem 7rem; }
        }
    </style>
</head>
<body>

<nav>
        <img src="images/logo.jfif"
             alt="Cibele Estudio"
             class="logo-img">
        <span id="logo-txt" class="logo-texto" style="display:none;">Cibele Estudio</span>
    </a>
    <div class="nav-links">
        <a href="Admin_productos.php">aaasd</a>
        <a href="#productos">Colección</a>
        <a href="#" class="btn-contacto" onclick="abrirContacto(event)">✨ Contacto</a>
    </div>
</nav>

<section class="hero">
    <div class="hero-tag">✦ Manualidades y artesanías ✦</div>
    <h1><img src="images/logo.jfif"
             alt="Cibele Estudio"
             class="logo-img2"></h1>
    <p class="hero-sub">Hechas con dedicación 💜</p>
    <p class="hero-desc">
        Creamos regalos únicos, algunos en stock y otros totalmente personalizados 💌<br>
        Podés escribirnos para contar tu idea o dejar que te asesoremos ✨
    </p>
    <div class="hero-badges">
        <span class="hero-badge">🌿 Hecho a mano</span>
        <span class="hero-badge">💜 Con intención</span>
        <span class="hero-badge">✨ Con amor</span>
    </div>
</section>

<?php if (isset($_SESSION['error'])): ?>
<div class="alert-wrap">
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
    </div>
</div>
<?php endif; ?>

<section id="productos">
    <div class="section-wrap">
        <div class="section-header">
            <h2>Nuestra Colección 🌸</h2>
            <p>Tocá los productos que te interesan y hacé tu pedido</p>
            <div class="dot-divider">· · · ✿ · · ·</div>
        </div>

        <div class="productos-grid">
            <?php foreach ($productos as $producto): ?>
            <div class="producto-card"
                 data-id="<?php echo $producto['id']; ?>"
                 data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                 data-precio="<?php echo $producto['precio']; ?>"
                 data-stock="<?php echo $producto['cantidad_disponible']; ?>"
                 onclick="toggleProducto(this)">

                <div class="check-badge">✓</div>

                <?php if ($producto['imagen']): ?>
                    <img class="producto-img" src="<?php echo UPLOADS_URL . htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                <?php else: ?>
                    <div class="imagen-placeholder">🌸<span>Sin imagen</span></div>
                <?php endif; ?>

                <div class="producto-info">
                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    <p class="producto-desc"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                    <div class="producto-footer">
                        <span class="precio">$<?php echo number_format($producto['precio'], 2); ?></span>
                        <?php if ($producto['cantidad_disponible'] > 0): ?>
                            <span class="stock-pill stock-ok">Disponible ✓</span>
                        <?php else: ?>
                            <span class="stock-pill stock-no">Agotado</span>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($producto['cantidad_disponible'] <= 0): ?>
                    <div class="agotado-overlay">Sin stock 🌙</div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="seleccion-bar" id="seleccionBar">
    <div class="bar-info">
        <div><strong id="countLabel">0</strong> productos seleccionados</div>
        <div class="bar-nombres" id="nombresLabel"></div>
    </div>
    <button class="btn-pedir" onclick="abrirModalPedido()">Hacer Pedido 💌</button>
</div>

<div class="modal-overlay" id="modalPedido" onclick="cerrarModalFuera(event,'modalPedido')">
    <div class="modal">
        <button class="modal-close" onclick="cerrarModal('modalPedido')">×</button>
        <div class="modal-title">Tu Pedido 🌸</div>
        <p class="modal-sub">Completá tus datos y te contactamos enseguida</p>
        <div class="resumen-box">
            <span class="resumen-label">Productos elegidos</span>
            <div id="resumenItems"></div>
        </div>
        <form method="POST" action="<?php echo BASE_URL; ?>">
            <input type="hidden" name="action" value="crear_pedido">
            <input type="hidden" name="productos_ids" id="productosIdsInput">
            <div class="form-row">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" placeholder="Tu nombre" required>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" placeholder="Apellido">
                </div>
            </div>
            <div class="form-group">
                <label>WhatsApp 📱</label>
                <input type="tel" name="telefono" placeholder="+54 9 261 000-0000" required>
            </div>
            <div class="form-group">
                <label>Email (opcional)</label>
                <input type="email" name="email" placeholder="tu@email.com">
            </div>
            <div class="form-group">
                <label>Dirección de entrega (opcional)</label>
                <input type="text" name="direccion" placeholder="Calle, número, ciudad">
            </div>
            <div class="form-group">
                <label>Comentarios o consultas 💬</label>
                <textarea name="comentarios" placeholder="¿Querés personalizar algo? ¿Alguna duda?"></textarea>
            </div>
            <button type="submit" class="btn-submit">Enviar Pedido ✨</button>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalContacto" onclick="cerrarModalFuera(event,'modalContacto')">
    <div class="modal" style="max-width:420px;">
        <button class="modal-close" onclick="cerrarModal('modalContacto')">×</button>
        <div class="contacto-modal">
            <div style="font-size:2.5rem;margin-bottom:0.5rem;">💜</div>
            <div class="modal-title">¡Hablemos!</div>
            <p class="modal-sub">Escribinos por donde prefieras</p>
            <div class="contacto-links">
                <a href="https://instagram.com/cibele_estudio" target="_blank" class="contacto-btn contacto-btn-ig">
                    <div class="contacto-icon contacto-icon-ig">📸</div>
                    <div class="contacto-btn-text">
                        <div class="contacto-btn-label">Instagram</div>
                        <div class="contacto-btn-value">@cibele_estudio</div>
                    </div>
                </a>
                <a href="https://wa.me/542612598902" target="_blank" class="contacto-btn contacto-btn-wa">
                    <div class="contacto-icon contacto-icon-wa">💬</div>
                    <div class="contacto-btn-text">
                        <div class="contacto-btn-label">WhatsApp</div>
                        <div class="contacto-btn-value">261 259-8902</div>
                    </div>
                </a>
            </div>
            <p class="contacto-note">
                También podés escribirnos para pedidos personalizados 💌<br>
                ¡Estamos felices de ayudarte!
            </p>
        </div>
    </div>
</div>

<footer>
    <div class="footer-logo">Cibele Estudio</div>
    <p>Manualidades y artesanías hechas con dedicación 💜</p> 
    <div class="footer-social">
        <a href="https://instagram.com/cibele_estudio" target="_blank">📸 @cibele_estudio</a>
        <a href="https://wa.me/542612598902" target="_blank">💬 261 259-8902</a>
    </div>
    <p style="margin-top:1rem;font-size:0.74rem;color:var(--muted);">© <?php echo date('Y'); ?> Cibele Estudio · Hecho con amor ✨</p>
</footer>

<script>
let seleccionados = {};

function toggleProducto(card) {
    if (card.dataset.stock == 0) return;
    const id = card.dataset.id;
    if (seleccionados[id]) {
        delete seleccionados[id];
        card.classList.remove('seleccionado');
    } else {
        seleccionados[id] = { nombre: card.dataset.nombre, precio: parseFloat(card.dataset.precio) };
        card.classList.add('seleccionado');
    }
    actualizarBarra();
}

function actualizarBarra() {
    const ids = Object.keys(seleccionados);
    const bar = document.getElementById('seleccionBar');
    if (ids.length === 0) { bar.classList.remove('visible'); return; }
    bar.classList.add('visible');
    document.getElementById('countLabel').textContent = ids.length;
    const nombres = ids.map(id => seleccionados[id].nombre);
    document.getElementById('nombresLabel').textContent =
        nombres.length > 2 ? nombres.slice(0,2).join(', ') + '...' : nombres.join(', ');
}

function abrirModalPedido() {
    const ids = Object.keys(seleccionados);
    const resumen = document.getElementById('resumenItems');
    resumen.innerHTML = '';
    ids.forEach(id => {
        const d = document.createElement('div');
        d.className = 'resumen-item';
        d.innerHTML = `<span>${seleccionados[id].nombre}</span><span class="resumen-precio">$${seleccionados[id].precio.toFixed(2)}</span>`;
        resumen.appendChild(d);
    });
    document.getElementById('productosIdsInput').value = ids.join(',');
    abrirModal('modalPedido');
}

function abrirContacto(e) { e.preventDefault(); abrirModal('modalContacto'); }
function abrirModal(id) { document.getElementById(id).classList.add('open'); document.body.style.overflow = 'hidden'; }
function cerrarModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = ''; }
function cerrarModalFuera(e, id) { if (e.target === document.getElementById(id)) cerrarModal(id); }
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { cerrarModal('modalPedido'); cerrarModal('modalContacto'); }
});
</script>
</body>
</html>