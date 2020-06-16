<?php
require_once __DIR__.'/includes/config.php'; 
use es\fdi\ucm\aw\Aplicacion as App;

App::getSingleton()->logout();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Cerrar sesion</title>
    </head>
    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Cerrar sesion</h1>
            <?php
                echo '<script type="text/javascript">
                alert("Se ha cerrado la sesion");
                window.location.assign("index.php");
                </script>';
             ?>
            </div>
        </div>
	</body>
</html>
