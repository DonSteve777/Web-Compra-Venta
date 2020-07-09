<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Producto;


  $nombreProd=$_GET['search'];
  $html = '';
  $html.= '<p>Estas buscando el producto '.$nombreProd.'</p>';
  $html.= Producto::searchProduct($nombreProd);
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
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <div class="text-center mt-3">
                        <h2>Resultados del filtrado...</h2></br>
                        <div>
                            <?php
                                echo $html;   
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
            </div>
        </div>
    </body>
</html>