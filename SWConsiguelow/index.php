<?php
    require_once __DIR__.'/includes/config.php';
    use es\fdi\ucm\aw\Producto;

    
$html = Producto::muestraProds();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Local Consiguelow</title>
    <link rel="icon" href="img/money.ico"/>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<div id="container">

    <?php
    //phpinfo();
        require("includes/common/cabecera.php");
        ?>
        <div id="flex-container">
     <?php
        require("includes/common/sidebarIzq.php");
    ?>      
    <div id="contenido">
    <?php
        echo $html;     
        ?>
            </div>
    <?php
       require("includes/common/sidebarDer.php");
       ?>
   </div>
</div>
    <footer>

    </footer>
   
</body>
</html>