<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/ImageUpload.php';
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\ImageUpload;


$idproducto = $_GET['id'];
$producto = Producto::findById($idproducto);
$imgSrc = ImageUpload::getSource($idproducto);
$htmlComprar='';
$htmlCarrito='';
$img =<<<EOF
    <img class="img-fluid border" src=$imgSrc alt="imagen no disponible">
EOF;

$id = $producto->id();
$htmlComprar.=<<<EOF
<a class="btn btn-info btn-lg" role="button" href="anadirPedido.php?id=$id&pagado=1">Comprar</a>
EOF;
$htmlCarrito.=<<<EOF
    <a class="btn btn-info btn-lg" role="button" href="anadeCarrito.php?id=$id&pagado=0">Añadir al carrito</a>
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
</head>

<body>
    <?php
    //phpinfo();
    //($nombreProd, $vendedor, $descripcion, $precio,$unidades, $talla, $color, $categoria)/*
    
        require("includes/common/cabecera.php");
    ?>
    <main role="main">
        <div class="container-fluid bg-light">
            <div class="row"> 
                <div class="col-5 m-3">
                    <?php
                        echo $img;    
                    ?>  
                </div>
                <div class="col-5 m-3">
                    <div class="d-flex flex-column m-3 ">
                        <div class="border-bottom text-center display-4" >
                            <?php
                                echo $producto->nombre();    
                            ?> 
                        </div>
                        <div class="m-3">
                        

                            <div class="mb-2">
                                <div class="d-inline p-2 font-weight-bold">Precio</div>
                                <div class="d-inline p-2 font-weight-ligh text-right"><?php echo $producto->precio()?> €</div>
                            </div>

                            <div class="mb-2">
                                <div class="d-inline p-2 font-weight-bold">Unidades</div>
                                <div class="d-inline p-2 font-weight-ligh"><?php echo $producto->unidades()?></div>
                            </div>

                            <div class="mb-2">
                                <div class="d-inline p-2 font-weight-bold">Talla</div>
                                <div class="d-inline p-2 font-weight-ligh"><?php echo $producto->talla()?></div>
                            </div>

                            <div class="mb-2">
                                <div class="d-inline p-2 font-weight-bold">Color</div>
                                <div class="d-inline p-2 font-weight-ligh"><?php echo $producto->color()?></div>
                            </div>

                            <div class="jumbotron">
                                <p class="lead"><?php echo $producto->descripcion()?></p>  
                                <div class="d-flex justify-content-end">   
                                    <p class="lead m-2">        
                                        <?php echo $htmlComprar?>                                    
                                    </p>
                                    <p class="lead m-2">
                                        <?php echo $htmlCarrito?> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
            </div>
        </div>
    </main>
</body>
</html>
