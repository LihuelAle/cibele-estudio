<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= TIENDA_NOMBRE ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>?page=tienda"><?= TIENDA_NOMBRE ?></a>
        <div>
            <a class="btn btn-outline-light" href="<?= BASE_URL ?>?page=carrito">
                🛒 Carrito <span id="contadorCarrito" class="badge bg-danger">0</span>
            </a>
        </div>
    </div>
</nav>

<div class="container my-4">