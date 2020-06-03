<?php
//require_once "config.php";
require_once __DIR__.'/includes/ImageUpload.php';
require_once __DIR__.'/includes/Imagen.php';
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\imageUpload;

$html = ImageUpload::getSource();
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Inicio de sesión</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <?php 
                echo $html; 
            ?>
      
            </div>
        </div>  
    </body>
</html>