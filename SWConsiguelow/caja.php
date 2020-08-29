<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Aplicacion;
use es\fdi\ucm\aw\Usuario;
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\ImageUpload;

$producto = NULL;
$usuario = NULL;
$idProducto = NULL;
$total = 0;
$htmlListado = '';
if (isset($_GET['id'])){
    $idProducto = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $producto = Producto::getById($idProducto);
}
$app = Aplicacion::getSingleton();
$htmlUsuario = '';
if ($app->usuarioLogueado()){
    $idUsuario= $app->userid();
    $usuario = Usuario::getById($idUsuario);
}

$idVendedor = $producto->vendedor();
$nombreVendedor = Usuario::getById($idVendedor)->nombreUsuario();
$nombreProducto = $producto->nombre();
$descripcion = $producto->descripcion();
$precio = $producto->precio();
$imgSrc = ImageUpload::getSource($idProducto);
$total += $precio;
$htmlListado.=<<<EOF
            <form action="vistaVendedor.php" method="POST">
                <button type="submit" class="btn btn-outline-info border-0" role="link" name="seller" value="$idVendedor">$nombreVendedor</button>
            </form>
            <div class="d-flex flex-row">
                <img class="img-thumbnail mr-4" src=$imgSrc alt="imagen no disponible"  width="92" height="92">
                <h4 class="card-title mr-4">$nombreProducto</h4>
                <small class="text-muted">$descripcion</small>
                <div class="d-flex flex-fill justify-content-end">
                    <div class="d-flex flex-column">
                        $precio €
                    </div>
                </div>
            </div>  
EOF;




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
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/caja.js"></script>  
  </head>

<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4 rounded" src="img/logo.gif" alt="Imagen no disponible" width="72" height="72">
            <h2>Pase por caja</h2>
        </div>
        <div class="row">
<!--carro-->
            <div class="col-md-4 order-md-2 mb-4">
                <ul class="list-group mb-3">    
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $nombreProducto?></h6>
                            <small class="text-muted"><?php echo $descripcion?></small>
                        </div>
                        <span class="text-muted"><?php echo $precio ?></span>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (€)</span>
                        <strong>€<?php echo $precio ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-center">
                        <button type="button" class="btn btn-info" id="pagarBtn" value=<?php $idProducto?> >Confirmar y pagar</button>
                    </li>
                </ul>
            </div>
        <!-- DAtos-->

            <div class="col-md-8 order-md-1">
                <div class="d-block my-3">
                    <h6> Modo de pago </h6>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="custom-control p-3 custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="custom-control p-3 custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">Debit card</label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="custom-control p-3 custom-radio">
                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="paypal">PayPal</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="card" id="enviara">
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

                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <?php echo $htmlListado; ?>
                        <div id="error"></div>
                    </div>
                </div>


            </div>
        </div>
        <div> <?php require("includes/common/footer.php"); ?></div>
    </div>
</body>
</html>
