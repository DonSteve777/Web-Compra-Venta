<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioLogin.php';
use es\fdi\ucm\aw\FormularioLogin;

$form = new FormularioLogin(); $html = $form->gestiona();
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
                <h1>Acceso al sistema</h1>
                <?php 
                echo $html; 
            ?>
      
            </div>
        </div>  
    </body>
</html>