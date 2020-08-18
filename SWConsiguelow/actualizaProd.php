<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\FormularioActualizar;
if(!isset($_SESSION['login'])){
    echo '<script type="text/javascript">
     alert("No puedes subir un producto si no has hecho login antes, se te mandará a login");
     window.location.assign("login.php");
     </script>';
 }
 else{
 $form = new FormularioActualizar(); 
 $html = $form->gestiona();
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
                    <h1 class="m-2">Actualizar producto</h1>
                    <?php
                        echo $html;
                        
                    ?>
                </div>
            </div>
            <div class="col-4">
        </div>
 
    </body>
</html>