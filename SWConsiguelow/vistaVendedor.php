<?php
use es\fdi\ucm\aw\Producto;


require_once __DIR__.'/includes/config.php';

function muestraProdsVendedor(){
  if(isset($_POST['seller'])){
  $vendedor = $_POST['seller'];
  $productoSeller= Producto::getByUser($vendedor);
  $html='';
  if(is_array($productoSeller)){
  foreach($productoSeller as $ps){
   
    $html.=$ps->generaTarjeta();
    }
  }
 return $html;
 }
 else {
    return "No ha podido ser";
 }
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
                        <h1 class="text-center">Articulos subidos por el vendedor </h1>
                    <?php
                        echo muestraProdsVendedor();
                    ?>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>  
    </body>
</html>