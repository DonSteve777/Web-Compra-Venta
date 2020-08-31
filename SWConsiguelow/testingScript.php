<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Pedido;

$idproducto = 2;
$pagado = 1;
$comprador = $_SESSION['userid'];
$guardado = NULL;
$pedido = new Pedido($idproducto, $pagado, $comprador);
$carrito = Pedido::getCarrito();
            $i=0;
            $encontrado = false;
            while($i < count($carrito) && !$encontrado){
                if ($carrito[$i]->producto() ==  $idproducto) $encontrado = true;
                else
                  $i++;
            }
            if ($encontrado){
              $pedido->setId($carrito[$i]->id());
              //$updated = Pedido::actualiza($pedido);
              $response = 'actualizado ';
             // $response.= $updated->id() ;
          }else {
             // Pedido::inserta($pedido);
              $response = 'insertado ';
             // $response.= $pedido->id();
          }
          $guardado = Pedido::guarda($pedido);
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

<?php echo $response ?>


</body>
</html>
