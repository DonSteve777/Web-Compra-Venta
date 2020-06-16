<?php
use es\fdi\ucm\aw\Usuario;
use es\fdi\ucm\aw\Aplicacion;

require_once __DIR__.'/includes/config.php';

function muestraTodosUsuarios(){
    $app = Aplicacion::getSingleton();
    if ($app->tieneRol('admin', 'Acceso Denegado', 'No tienes permisos suficientes para administrar la web.')) {
  $html= Usuario::muestraTodosUsuarios();
  return $html;
    }
}

?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Usuarios existentes</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Todos los usuarios de la web</h1>
            <?php
                echo muestraTodosUsuarios();
            ?>
            </div>
        </div>  
    </body>
</html>