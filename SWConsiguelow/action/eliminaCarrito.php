<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){

        $id = $_GET['id'];
        if(Pedido::eliminaCarrito($id)){
            echo '<script type="text/javascript">
        alert("Producto eliminado del carrito con exito");
        window.location.assign("index.php");
        </script>';
        }
    }
    else{
        '<script type="text/javascript">
        alert("No ha sido posible");
        window.location.assign("login.php");
        </script>';
    }