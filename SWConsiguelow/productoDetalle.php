<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/ImageUpload.php';
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\ImageUpload;

//$html = Producto::muestraProds();
$idproducto = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if(!$idproducto) {
    exit();
}
$producto = Producto::getById($idproducto);
$imgSrc = ImageUpload::getSource($idproducto);
$htmlComprar='';
$htmlCarrito='';
$img =<<<EOF
    <img class="img-fluid border" src=$imgSrc alt="imagen no disponible">
EOF;

$id = $producto->id();
$htmlComprar =<<<EOF
    <button id="buy" type="button" class="btn btn-info btn-lg" >Comprar</button>
EOF;
$htmlCarrito=<<<EOF
    <button id="addCart" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#exampleModalCentered">Añadir al carrito</button>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script> 

    <script>
        $(function() {
            $("#mensaje").hide();
            $("#addCart").click(function() {
                var e = {
                "id" : 1,
                "pagado"   : 0
              };
                $.post( "anadirPedido.php", { id: $id, pagado: "0" }, function(data, status) {
                    $("#mensaje").show();
                }
                    //$("#mensaje").html(data);
                   /* .done(function (data, textStatus, jqXHR) {
                $("#mensaje").html(data);*/           
                })
            });
        })
    </script>       
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
                            <div class="mb-3" >
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
                            </div>
                            <div class="bg-dark text-white rounded p-3">
                                <div>
                                    <p class="lead"><?php echo $producto->descripcion()?></p>  
                                </div>
                                <div class="m-1 d-flex flex-row">  
                                    <div class="m-1" >
                                            <?php echo $htmlComprar?>                                    
                                    </div> 
                                    <div class="m-1">
                                            <?php echo $htmlCarrito?> 
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal text-dark" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenteredLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="col-2">
                </div>
            </div>
        </div>
    </main>
</body>
</html>
