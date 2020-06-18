<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\FormularioCategoria;
use es\fdi\ucm\aw\Aplicacion;
$form = new FormularioCategoria();
$html = $form->gestiona();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Dar de alta una categoria</title>
    </head>
    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Añadir categoria</h1>
                <?php
               echo $html;
                ?>
            </div>
        </div>  
    </body>
</html>