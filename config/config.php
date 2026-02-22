<?php

// ================================
// CONFIGURACIÓN GENERAL
// ================================

// Mostrar errores (solo desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// NOMBRE DE LA CARPETA DEL PROYECTO EN htdocs
// ⚠️ ESTO SÍ LO TENÉS QUE EDITAR SI CAMBIÁS LA CARPETA
$baseFolder = 'cibele_studio';

// BASE URL
define(
    'BASE_URL',
    'http://' . $_SERVER['HTTP_HOST'] . '/' . $baseFolder . '/'
);

// Zona horaria
date_default_timezone_set('America/Argentina/Mendoza');?>