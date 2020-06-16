<?php
use es\fdi\ucm\aw\Pedido;


require_once __DIR__.'/includes/config.php';


function listadoPedidos()
{
  $html = '';
  $html.= 'Pedidos del usuario';
  $html .= '';
  $pedido = Pedido::muestraPedidos();
  foreach($pedido as $p) {
    $html .= '<li> IdPedido: '.$p->id();
    $html .= 'Producto: '.$p->producto();
    $html .= '</li>';
  }
    return $html;
}
?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Pedidos</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Pedidos realizados <?php $_SESSION['nombre']?></h1>
            <?php
                echo listadoPedidos();
            ?>
            </div>
        </div>  
    </body>
</html>

