<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\ImageUpload;

function allCardsProduct($prod=array()){ 
    $html = '';
    $htmlimg = '';
    foreach($prod as $key => $fila){
        $id =  $fila['id'];
        $imgSrc = ImageUpload::getSource($id);
        $precio = $fila['precio'];
        $html .=<<<EOF
                        <div class="col-md-4">
                            <div class="card mb-4 text-center bg-light border-0">
                                <div class="card-img-top">       
EOF;
        if($imgSrc){
            $html.=<<<EOF
                                    <a href="producto.php?id=$id">
                                        <img class="img-thumbnail" src=$imgSrc alt="imagen no disponible">
                                    </a>
EOF;
        }else{
            $html.=<<<EOF
                                    <a href="producto.php?id=$id">
                                        <p>Imagen no disponible para este producto</p>
                                    </a>
EOF;    }
$html .=<<<EOF
                                </div>
                                <div class="card-body justify-content-end"> 
                                    $precio €
                                </div>
                            </div>
                        </div>
EOF;
    }
    return $html;
}

$html='';
$prods = Producto::getAllOthers();
if (!is_array($prods)){
    $html.= allCardsProduct($prods);
}else{
    $html='<p> Vaya, parece que nadie ha puesto nada en venta</p>';
    error_log("select de productos ajenos no devolvió un array");
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
    //phpinfo();
        require("includes/common/cabecera.php");
    ?>
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
</body>
</html>