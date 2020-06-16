<?php
use es\fdi\ucm\aw\Producto;


require_once __DIR__.'/includes/config.php';

function muestraProdsUsuario(){
  $idUsuario = $_SESSION['userid'];
  $html= Producto::muestraProdsUsuario($idUsuario);
  return $html;
}

?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Mostrar producto</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Productos subidos por el usuario</h1>
            <?php
                echo muestraProdsUsuario();
            ?>
            </div>
        </div>  
    </body>
</html>