<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\Categoria;


if (isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id){
        echo 'Error en la validación de id: se esperaba un entero';
        exit();
    }   
}
$nombre = Categoria::getById($id)->nombre();
$productos = Producto::getByCat($id);
$html='';
if (is_array($productos)){
    foreach($productos as $value){
        $html.=$value->generaTarjeta();
    }
}else {
    $html= $productos;
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
    <?php
    //phpinfo();
        require("includes/common/cabecera.php");
    ?>
    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <h2>
                    <?php 
                        echo $nombre;
                    ?>
                </h2>
                <div class="row">
              
                <?php
                    echo $html;
                ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>