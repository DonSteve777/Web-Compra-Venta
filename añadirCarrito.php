
<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\FormularioCarrito;
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Añadir un producto al carrito</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Añadir producto</h1>
            <?php 
                $form = new FormularioCarrito(); $form->gestiona();
            ?>
            </div>
        </div>  
    </body>
</html>