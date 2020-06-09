<?php
use es\fdi\ucm\aw\Categoria;

require_once __DIR__.'/includes/config.php';


function listadoCategorias()
{
  $html = '';
  $html.= 'Categorias ya creadas';
  $html .= '';
  $cat= Categoria::muestraCats();
  foreach($cat as $c) {
    $html .= '<li>'.$c->nombre();
    $html .= '</li>';
  }
      return $html;
}
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Pedidos de un usuario</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Categorias existentes</h1>
                <?php
                echo listadoCategorias();   
                ?>
                </br>
            </div>
        </div>  
    </body>
</html>