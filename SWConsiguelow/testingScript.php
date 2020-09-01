<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Pedido;
use es\fdi\ucm\aw\Talla;
use es\fdi\ucm\aw\Producto;

$idvendedor = $app->userid();
$nombreProd = 'nombreProd';
$descripcion= 'desc';
$precio =2;
$talla= new Talla();
$color='rojo';
$categoria =2;
$unidades=3;
$imgUpload='';
$producto = Producto::añadeProd($nombreProd, $idvendedor, $descripcion, $precio,$unidades,1,$color,$categoria);
var_dump($producto);

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
<link rel="stylesheet" href="css/modal.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/modal.js"></script> 


</head>
<body>



</body>
</html>
