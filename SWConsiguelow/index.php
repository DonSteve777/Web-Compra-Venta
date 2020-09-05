<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\ImageUpload;
use es\fdi\ucm\aw\Pedido;


$html='';
$prods = Producto::getAliens();
if (is_array($prods)){
    foreach($prods as $value){
        if (!Pedido::isPaid($value->id())){ $html.=$value->generaTarjeta();}
    }
}else{
    $html.=$prods;
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

</head>

<body>
    <?php require("includes/common/cabecera.php");?>
    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row"> 
                    <?php
                        echo $html;
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php require("includes/common/footer.php"); ?>

</body>
</html>