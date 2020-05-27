<?php
use es\fdi\ucm\aw\Pedido;

require_once __DIR__.'/includes/config.php';
?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Pedidos de un usuario</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Pedidos del usuario <?php echo $_SESSION['username'];?></h1>
            <?php 
                $result = Pedido::muestraPedidos();
                $array = $result;
                foreach($array as $key => $fila){
                ?>
                <li>IdPedido: <?php echo $fila['idPedido'];?></br>
                Fecha Pedido: <?php echo $fila['fecha'];?></br>
                Nombre Producto(s): <?php echo $fila['nombreProd'];?></br>
                Pagado: <?php echo $fila['pagado'];?></br>
                </br>
                <?php  
                }
            ?>
            </div>
        </div>  
    </body>
</html>