<?php
use es\fdi\ucm\aw\Categoria;
use es\fdi\ucm\aw\Aplicacion;

require_once __DIR__.'/includes/config.php';
function listadoCategorias()
{
    $app = Aplicacion::getSingleton();
    if ($app->tieneRol('admin', 'Acceso Denegado', 'No tienes permisos suficientes para administrar la web.')) {
   $html = '';
   $html.= 'Categorias ya creadas';
   $html .= '';
   $html = Categoria::muestraTodasCategorias();
   return $html;
    }
}
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
        <div class="row align-items-start">
        </div>
        <div class="row align-items-center">
            <div class="col-4">
            </div>
            <div class="col-4">
                <div class="m-3">
                    <h1 class="m-2 h3 text-center ">Categorias existentes</h1>
                    <?php
                        echo listadoCategorias();   
                        ?>
                </div>
            </div>
            <div class="col-4">
            </div>
        </div>
        <div class="row align-items-end">
        </div>  
        
    </body>
</html>