<?php
require_once __DIR__.'/includes/config.php'; 
use es\fdi\ucm\aw\Aplicacion as App;

$html = '';
App::getSingleton()->logout();
if (!App::getSingleton()->usuarioLogueado()){
    $html = <<<EOF
    <div class="alert alert-success text-center" role="alert">
    <strong>Hasta luego!</strong> Su sesión finalizó correctamente
    </div>
EOF;
}
else{
    $html = <<<EOF
    <div class="alert alert-danger text-center" role="alert">
  <strong>Oh vaya!</strong> No se ha finalizado la sesión
    </div>
EOF;
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script> 
</head>

<body>
    <?php require("includes/common/cabecera.php");
     echo $html
    ?>
    <?php require("includes/common/footer.php"); 
    ?>

</body>
</html>