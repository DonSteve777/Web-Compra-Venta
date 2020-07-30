<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\ImageUpload;



$html='';
$prods = Producto::getAliens();
foreach($prods as $value){
    $html.=$value->generaTarjeta();
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
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