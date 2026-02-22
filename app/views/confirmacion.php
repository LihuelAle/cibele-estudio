<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido recibido — Cibele Estudio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<nav>
    <a href="<?php echo BASE_URL; ?>" class="logo">Cibele <span>Estudio</span></a>
    <div class="nav-right">
        <a href="<?php echo BASE_URL; ?>">Volver a la tienda</a>
    </div>
</nav>

<div style="display:flex;align-items:center;justify-content:center;min-height:80vh;padding:2rem;">
    <div style="text-align:center;max-width:500px;">

        <div style="
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #b8965a, #d4b483);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2.2rem;
        ">✓</div>

        <h1 style="
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.8rem;
            font-weight: 300;
            margin-bottom: 0.8rem;
            color: #1a1510;
        ">¡Pedido recibido!</h1>

        <p style="color:#7a6f60;font-size:0.95rem;line-height:1.9;margin-bottom:2.5rem;font-weight:300;">
            Gracias por tu pedido. 
            Nos vamos a comunicar con vos a la brevedad por WhatsApp o email 
            para coordinar los detalles de la entrega.
        </p>

        <?php if (isset($pedido) && $pedido): ?>
        <div style="
            background: white;
            border: 1px solid #e0d5c5;
            padding: 1.2rem 1.6rem;
            text-align: left;
            margin-bottom: 2rem;
            border-radius: 2px;
        ">
            <div style="font-size:0.7rem;letter-spacing:0.16em;text-transform:uppercase;color:#7a6f60;margin-bottom:0.8rem;">Resumen</div>
            <div style="font-size:0.9rem;color:#1a1510;line-height:2;">
                <div><strong>Cliente:</strong> <?php echo htmlspecialchars($pedido['nombre_cliente']); ?></div>
                <div><strong>Pedido #:</strong> <?php echo $pedido['id']; ?></div>
                <div><strong>Productos:</strong> <?php echo htmlspecialchars($pedido['productos'] ?? '—'); ?></div>
            </div>
        </div>
        <?php endif; ?>

        <a href="<?php echo BASE_URL; ?>" style="
            display: inline-block;
            padding: 0.8rem 2.5rem;
            border: 1px solid #e0d5c5;
            color: #7a6f60;
            text-decoration: none;
            font-size: 0.78rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            transition: all 0.2s;
            border-radius: 1px;
        " onmouseover="this.style.borderColor='#b8965a';this.style.color='#b8965a'"
           onmouseout="this.style.borderColor='#e0d5c5';this.style.color='#7a6f60'">
            Volver a la tienda
        </a>
    </div>
</div>

<footer style="border-top:1px solid #e0d5c5;padding:2rem;text-align:center;margin-top:2rem;">
    <div style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:300;letter-spacing:0.12em;margin-bottom:0.5rem;">Cibele Estudio</div>
    <p style="font-size:0.78rem;color:#7a6f60;">Joyería artesanal hecha con amor</p>
</footer>

</body>
</html>