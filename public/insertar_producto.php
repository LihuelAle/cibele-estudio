<?php
if(class_exists('ControladorDeProducto')){
    echo "Clase cargada ✅";
} else {
    echo "Clase NO cargada ❌";
}
require_once __DIR__ . "/../app/control/controladordeproducto.php";

if (class_exists('ControladorDeProducto')) {
    echo "Clase cargada correctamente.";
} else {
    echo "No se pudo cargar la clase ControladorDeProducto.";
}
// Crear objeto Producto
$producto = new Producto($conn);

// Datos de prueba
$nombre = "Collar de perlas";
$descripcion = "Collar elegante para cualquier ocasión";
$precio = 1200.50;
$imagen = "collar.jpg";

// SQL para insertar
$sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen);

if($stmt->execute()) {
    echo "Producto insertado correctamente";
} else {
    echo "Error al insertar: " . $stmt->error;
}
?>