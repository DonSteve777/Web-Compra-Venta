<?php
use es\fdi\ucm\aw\Pedido;


require_once __DIR__.'/includes/config.php';


function listadoPedidos()
{
  $html = '';
  $pedido= Pedido::muestraPedidos();
  $html.=<<<EOF
  <ul class="list-group">
EOF;
if (is_array($pedido)){
  foreach($pedido as $p){
      $idPedido = $p->id();
      $idProd = $p->producto();
      $html.=<<<EOF
          <li class="list-group-item">
              <div class="d-flex flex-row">
                  <div class="p-2 m-3 flex-fill">
                      <p>Producto: $idProd</p>
                  </div>
                  <div class="d-flex flex-wrap align-content-center">
                  <a class="text-center btn btn-info" href="cancelaPedido.php?id=$idPedido">
                      Cancelar pedido</a>
              </div>
          </li>     
EOF;
  }
  $html.=<<<EOF
  </ul>
EOF;
    }
    else{
    $html.="No hay pedidos";
}
  return $html;
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
        <div class="container mt-3">
            <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <h1 class="text-center">Pedidos del usuario</h1>
                    <?php
                        echo listadoPedidos();
                    ?>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>  
    </body>
</html>




