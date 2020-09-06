<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Producto;

function filtrado(){
$nombreProd=$_GET['search'];
  $html = '';
  $html.='<h2>Resultados del filtrado...</h2>';
  $html.= '<p>Resultados que coinciden con tu busqueda: '.$nombreProd.'</p>';
  $prods= Producto::getByName($nombreProd);
 if(is_array($prods)){
  foreach($prods as $p){
    $html.=$p->generaTarjeta();
    }
   }
    else{
        $html.= "No hay coincidencias";
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

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/carro.js"></script>
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
                        
                        <div>
                            <?php
                                echo filtrado();
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