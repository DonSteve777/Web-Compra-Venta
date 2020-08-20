<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Pedido as Pedido;
use es\fdi\ucm\aw\Aplicacion;
use es\fdi\ucm\aw\Usuario;



$pedidos = Pedido::getCarrito();
$counter = count($pedidos);
$app = Aplicacion::getSingleton();
$htmlUsuario = '';
if ($app->usuarioLogueado()){
    $idUsuario= $app->userid();
    $usuario = Usuario::getById($idUsuario);
    //$htmlUsuario .= $usuario->nombre();

}


?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Local Consiguelow</title>
    <link rel="icon" href="img/money.ico"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4 rounded" src="img/logo.gif" alt="Imagen no disponible" width="72" height="72">
    <h2>Pase por caja</h2>
  </div>
  
  <body class="bg-light">
    <div class="container">
    <div class="row">
<!--carro-->
    <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Tu carrito</span>
                <span class="badge badge-secondary badge-pill"><?php echo $counter?></span>
            </h4>
            <ul class="list-group mb-3">    
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$12</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Second product</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$8</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Third item</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$5</span>
                </li>
                
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$20</strong>
                </li>
            </ul>
        </div>
<!-- DAtos-->
    <div class="col-md-8 order-md-1">
        
        <h4 class="mb-3">Pago</h4>
        <div class="d-block my-3">
            <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle ">Enviar a</h6>
                <div class="p-3">
                    <p><?php echo $usuario->nombre();?>
                    <p><?php echo $usuario->dni(); ?>
                    <p><?php echo $usuario->direccion(); ?>
                    <p><?php echo $usuario->telefono(); ?>
                    <p><?php echo $usuario->ciudad(); ?>
                    <p><?php echo $usuario->codigoPostal(); ?>
                    <p><?php echo $usuario->tarjetaCredito(); ?>
                </div>
                <button type="button" id="editarBtn" class="btn btn-outline-info border-0">Editar</button>
            </div>
        </div>
        
        


        
    </div>

    <?php require("includes/common/footer.php"); ?>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="form-validation.js"></script></body>
</html>
