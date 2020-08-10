<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\FormularioVender;
function vender(){
if(!isset($_SESSION['login'])){
    $html=<<<EOF
    <div class="alert alert-info" role="alert">
            No has iniciado sesion!
    </div>
EOF;
 }
 else{
 $form = new FormularioVender(); 
 $html = $form->gestiona();
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
</head>
    <body>
        <?php
            require("includes/common/cabecera.php");
        ?>
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
                <div class="d-flex flex-column bg-light m-3">
                    <h1 class="m-2">Subir un producto</h1>
                    <?php
                        echo vender();
                        
                    ?>
                    <?php require("includes/common/footer.php"); ?>
                </div>
            </div>
            <div class="col-4">
            
        </div>
        
    </body>
</html>