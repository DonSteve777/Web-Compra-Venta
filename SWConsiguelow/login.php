<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioLogin.php';
use es\fdi\ucm\aw\FormularioLogin;

$form = new FormularioLogin(); 
$html = $form->gestiona();

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

<body class="text-center bg-light">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="container d-flex flex-column mt-5">
                <?php 
                    echo $html; 
                ?>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</body>
</html>

