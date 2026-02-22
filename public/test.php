<?php
require_once __DIR__ . "/../app/control/ControladorDeProducto.php";

if(class_exists('ControladorDeProducto')){
    echo "Clase cargada correctamente ✅";
} else {
    echo "Clase NO cargada ❌";
}