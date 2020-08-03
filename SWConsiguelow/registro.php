<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioRegistro.php';
use es\fdi\ucm\aw\FormularioRegistro;
$form = new FormularioRegistro(); 
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

<body>

<div id="contenedor">

<?php
	require("includes/common/cabecera.php");
?>

<div class="row">
    <div class="col-4">
    </div>
    <div class="col-4">
        <div class="d-flex flex-column bg-light m-3">
            <h1 class="m-2">Registro de usuario</h1>
            <?php
                echo $html;
            ?>
        </div>
    </div>
    <div class="col-4">
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/ejercicio4.js"></script>

</html>