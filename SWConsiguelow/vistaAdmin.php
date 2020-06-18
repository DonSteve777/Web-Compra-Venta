<?php

require_once __DIR__.'/includes/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Local Consiguelow</title>
    <link rel="icon" href="img/money.ico"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <?php
        require("includes/common/cabecera.php");
    ?>
    <?php
    if ($app->tieneRol('admin', 'Acceso Denegado', 'No tienes permisos suficientes para administrar la web.')) {
    ?>
    <div class="row text-center">
        <div class="col-4">
        </div>
        <div class="col-4">
            <div class="d-flex flex-column mt-3">
                <h1>Consola de administración</h1></br>
                    <ul class="list-group">
                        <li class="list-group-item"> 
                            <a href='anadeCategoria.php'>Añadir una categoria</a>
                        </li>
                        <li class="list-group-item">
                            <a href='listaCategorias.php'>Ver categorias ya existentes</a>
                        </li>
                        <li class="list-group-item">
                            <a href='vistaUsuarios.php'>Ver todos los usuarios de la web</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-4">
        </div>
    </div>
    <?php
    }
    ?>
</body>
</html>