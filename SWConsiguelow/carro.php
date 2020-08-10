<?php
use es\fdi\ucm\aw\Pedido;
use es\fdi\ucm\aw\Aplicacion as App;
use es\fdi\ucm\aw\Producto as Producto;
use es\fdi\ucm\aw\ImageUpload as ImageUpload;




require_once __DIR__.'/includes/config.php';

if (!App::getSingleton()->usuarioLogueado())
    header('Location: login.php');

$pedidos = Pedido::getCarrito();
$counter = count($pedidos);

$htmlListado = '';
$htmlTotal = '';
$total = 0;
foreach($pedidos as $value){
    $producto = Producto::getById($value->producto());
    $nombre = $producto->nombre();
    $descripcion = $producto->descripcion();
    $precio = $producto->precio();
    $imgSrc = ImageUpload::getSource($value->producto());
    $total += $precio;

    $htmlTotal.= <<<EOF
    <li class="list-group-item d-flex justify-content-between lh-condensed">
    <div>
        <h6 class="my-0">$nombre</h6>
    </div>
    <span class="text-muted">$precio</span>
</li>
EOF;
    $htmlListado.=<<<EOF
    <div class="card m-3">
        <div class="card-header">
         Vendedor
        </div>
        <div class="card-body">
            <div class="d-flex flex-row">
                <img class="img-thumbnail mr-4" src=$imgSrc alt="imagen no disponible"  width="92" height="92">
                <h4 class="card-title mr-4">$nombre</h4>
                <small class="text-muted">$descripcion</small>
                <div class="d-flex flex-fill justify-content-end">
                    <div class="d-flex flex-column">
                        $precio €
                        <div class="d-inline mt-2">
                            <a href=#  class="border border-primary border-top-0 border-bottom-0 border-left-0 p-2">Comprar este artículo</a>
                            <a href=# id="remove" class="m-1">Eliminar </a>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
  </div>
EOF;
};
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

    <script src="js/jquery-3.5.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
<script src="js/carro.js"></script>
</head>

<body>
<?php require("includes/common/cabecera.php");?>
<div class="bg-light">
<div class="row container-fluid p-3">
    <div class="col-1"></div>
    <div class="col-md-7">
        <h1 class="text-center">Carrito del usuario</h1>
        <?php echo $htmlListado; ?>
    </div>
    <div class="col-3 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Lista de items</span>
            <span class="badge badge-secondary badge-pill"><?php echo $counter?></span>
        </h4>
        <ul class="list-group mb-3">    
            <li class="list-group-item">
                <div class="container-fluid">
                    <button type="button" class="btn btn-block btn-primary">Caja</button>
                </div>
            </li>
            <?php echo $htmlTotal;?>
            <li class="list-group-item d-flex justify-content-between">
          <span>Total (Euros)</span>
          <strong><?php echo $total?></strong>
        </li>
      </ul>
        </ul>
    </div>
    <div class="col-1"></div>


</div>

</body>
</html>



