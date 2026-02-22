<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../app/control/ControladorDeProducto.php";

$controlador = new ControladorDeProducto($conn);
$productos = $controlador->mostrarProductos();
if(class_exists('ControladorDeProducto')){
    echo "Clase cargada ✅";
} else {
    echo "Clase NO cargada ❌";
}
exit;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Tienda</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        .productos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .producto {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
        }
        .agregar-btn {
            margin-bottom: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .agregar-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Productos</h1>
    <a class="agregar-btn" href="agregar_producto.php">+ Agregar Producto</a>

    <div class="productos">
        <?php if(count($productos) > 0): ?>
            <?php foreach($productos as $prod): ?>
                <div class="producto">
                    <h3><?php echo htmlspecialchars($prod['nombre']); ?></h3>
                    <p><?php echo htmlspecialchars($prod['descripcion']); ?></p>
                    <p>Precio: $<?php echo $prod['precio']; ?></p>
                    <?php if($prod['imagen']): ?>
                        <img src="images/<?php echo $prod['imagen']; ?>" alt="<?php echo htmlspecialchars($prod['nombre']); ?>" width="150">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos aún.</p>
        <?php endif; ?>
    </div>
</body>
</html>