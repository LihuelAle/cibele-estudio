<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "tienda";

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db_name);

// Revisar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Activar reportes de errores
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>