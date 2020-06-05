<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Producto;


function listadoMensajesRecursivo($nombreProd = NULL)
{
    $nombreProd=$_GET['search'];
  $html = '';
  $html.= '<li>Estas buscando el producto '.$nombreProd;
  $html .= '</li>';
  $prod = Producto::muestraProdPorNombre($nombreProd);
  $html .= $prod[0]->descripcion(); //var_dump($prod);
  return $html;
}
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Busqueda</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Filtrado</h1>
             <h2>Resultados del filtrado...</h2></br>
             <?php
                echo listadoMensajesRecursivo();   
            ?>
            </div>
        </div>  
    </body>
</html>