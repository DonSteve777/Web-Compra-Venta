<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';

function eliminaProd(){
    $response ='';
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $idProd = $_POST['delete'];
        if(isset($idProd)){
        $eliminado = Producto::eliminaById($idProd);
        if($eliminado){
            $response .= <<<EOF
            <div class="alert alert-success">
            <strong>¡Pedido eliminado!</strong> Ir al<a href="index.php" class="alert-link"> inicio</a>.
            </div>
EOF;
        }
      }
    }
    else{
        $response= <<<EOF
        <div class="alert alert-info">
        <strong>¡No has iniciado sesion!</strong> Deberias <a href="login.php" class="alert-link">ir a login</a>.
        </div>
EOF;
    }
    return $response;
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
      echo eliminaProd();
    ?>
    <?php require("includes/common/footer.php"); 
    ?>

</body>
</html>
    