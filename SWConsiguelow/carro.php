<?php
use es\fdi\ucm\aw\Pedido;
use es\fdi\ucm\aw\Aplicacion as App;
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\ImageUpload;
use es\fdi\ucm\aw\Usuario;


require_once __DIR__.'/includes/config.php';

if (!App::getSingleton()->usuarioLogueado())
    header('Location: login.php');

$pedidos = Pedido::getCarrito();
$counter = count($pedidos);

$htmlListado = '';
$total = 0;
$htmlTotal =<<<EOF
<div class="col-md-3 col-12 mb-4" >
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Lista de items</span>
            <span class="badge badge-secondary badge-pill"  id='counter'>$counter</span>
        </h4>
        <ul class="list-group mb-3">    
            <li class="list-group-item" id='test'>
                <div class="container-fluid">
                    <button type="button" class="btn btn-block btn-primary">Caja</button>
                </div>
            </li>
EOF;
foreach($pedidos as $value){
    $idPedido = $value->id();
    $id = $value->producto();
    $producto = Producto::getById($id);
    $idVendedor = $producto->vendedor();
    $nombreVendedor = Usuario::getById($idVendedor)->nombreUsuario();
    $nombre = $producto->nombre();
    $descripcion = $producto->descripcion();
    $precio = $producto->precio();
    $imgSrc = ImageUpload::getSource($value->producto());
    $total += $precio;
    $idli = $idPedido . 'li';
    $htmlTotal.= <<<EOF
    <li class="list-group-item d-flex justify-content-between lh-condensed" id=$idli>
            <h6 class="my-0">$nombre</h6>
        <span class="text-muted">$precio</span>
    </li>
EOF;
    $htmlListado.=<<<EOF
    <div class="card m-3" id=$idPedido>
        <div class="card-header">
            <form action="vistaVendedor.php" method="POST">
                <button type="submit" class="btn btn-outline-info border-0" role="link" name="seller" value="$idVendedor">$nombreVendedor</button>
            </form>
        </div>
        <div class="card-body">
            <div class="d-flex flex-row">
            <a href="productoDetalle.php?id=$id">
                <img class="img-thumbnail mr-4" src=$imgSrc alt="imagen no disponible"  width="92" height="92">
            </a>
                <h4 class="card-title mr-4">$nombre</h4>
                <small class="text-muted">$descripcion</small>
                <div class="d-flex flex-fill justify-content-end">
                    <div class="d-flex flex-column">
                        $precio €
                        <div class="d-flex flex-row m-2">
                            <button type="button" class="btn comprar mr-2 btn-primary" value=$id>Comprar este artículo</button>
                            <button type="button" class="btn eliminar btn-primary" value=$idPedido>Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
EOF;
};
$htmlTotal.=<<<EOF
<li class="list-group-item d-flex justify-content-between">
    <span>Total (Euros)</span>
    <strong id='total'>  $total</strong>
</li>
</ul>
</div>

EOF;
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
        <?php echo $htmlTotal ?>
        <div class="col-1"></div>
    </div>
</div>
</body>
</html>



