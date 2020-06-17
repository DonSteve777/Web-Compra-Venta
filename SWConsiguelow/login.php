<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioLogin.php';
use es\fdi\ucm\aw\FormularioLogin;

$form = new FormularioLogin(); $html = $form->gestiona();
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

    <body class="text-center">
        <section class="container">
            
            <div class="row align-items-center">
                <div class="col-3"></div>
                <div class="col-6">
                    <img src="img/logo.gif" class="rounded-circle" alt="imagen no disponible" width="70" height="70">
                    <h1>Acceso al sistema</h1>
                    <?php 
                        echo $html; 
                    ?>
                </div>
                <div class="col-3"></div>
            </div>
        </section>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>