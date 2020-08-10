<?php
use es\fdi\ucm\aw\Pedido;
use es\fdi\ucm\aw\Aplicacion as App;


require_once __DIR__.'/includes/config.php';

if (!App::getSingleton()->usuarioLogueado())
    header('Location: login.php');

function listadoCarrito()
{
  $html = '';
  $carrito = Pedido::getCarrito();
  $html.=<<<EOF
  <ul class="list-group">
EOF;
if (is_array($carrito)){
  foreach($carrito as $c){
      $idPedido = $c->id();
      $idProd = $c->producto();
      $html.=<<<EOF
          <li class="list-group-item">
              <div class="d-flex flex-row">
                  <div class="p-2 m-3 flex-fill">
                      <p>Producto: $idProd</p>
                  </div>
                  <div class="d-flex flex-wrap align-content-center">
                  <a class="text-center btn btn-info" href="eliminaCarrito.php?id=$idPedido">
                      Quitar</a>
                  <a class="btn btn-info btn-lg" role="button" href="anadirPedido.php?id=$idProd&pagado=1">Comprar</a>
              </div>
              
          </li>     
EOF;
  }
  $html.=<<<EOF
  </ul>
EOF;
    }
    else{
    $html.="Carrito vacio";
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
                        <h1 class="text-center">Carrito del usuario</h1>
                    <?php
                        echo listadoCarrito();
                    ?>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>  
    </body>
</html>



