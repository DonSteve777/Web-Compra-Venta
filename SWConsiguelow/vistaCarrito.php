<?php
use es\fdi\ucm\aw\Pedido;


require_once __DIR__.'/includes/config.php';


function listadoCarrito()
{
  $html = '';
  $html.= 'Carrito del usuario';
  $html .= '';
  $pedido = Pedido::muestraCarrito();
  foreach($pedido as $p) {
    $html .= '<li>'.$p->producto();
    $html .= '</li>';
  }
      return $html;
}
?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Carrito</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Carrito del usuario <?php $_SESSION['nombre']?></h1>
            <?php
                echo listadoCarrito();
            ?>
            </div>
        </div>  
    </body>
</html>

