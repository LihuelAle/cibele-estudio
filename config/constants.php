<?php
// ============================================
// CIBELE ESTUDIO — Configuración
// ============================================

// URL base del proyecto (con barra al final)
define('BASE_URL', 'http://localhost/cibele_estudio/public/');

// URLs de archivos
define('UPLOADS_URL', BASE_URL . 'uploads/');
define('UPLOAD_PATH', dirname(__DIR__) . '/public/uploads/');

// Info de la tienda
define('TIENDA_NOMBRE', 'Cibele Estudio');
define('ADMIN_EMAIL',   'tucorreo@gmail.com');
define('ADMIN_URL',     BASE_URL . '?page=admin');

// Base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'cibele_estudio');
define('DB_USER', 'root');
define('DB_PASS', '');

// App
define('APP_VERSION', '1.0.0');
define('APP_ENV', 'development');