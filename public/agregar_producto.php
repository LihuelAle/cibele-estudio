<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../app/control/ControladorDeProducto.php";

$controlador = new ControladorDeProducto($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $imagen = null;
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0){
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imagen = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . "/images/" . $imagen);
    }

    $controlador->insertarProducto($nombre, $descripcion, $precio, $imagen);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
</head>
<body>
    <h1>Agregar Producto</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion" required></textarea><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" required><br><br>

        <label>Imagen:</label><br>
        <input type="file" name="imagen" accept="image/*"><br><br>

        <button type="submit">Agregar</button>
    </form>
</body>
</html>