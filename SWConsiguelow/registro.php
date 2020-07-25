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
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/ejercicio4.js"></script>
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
</html>