<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $id = $_POST['item'];
        if(isset($id)){
            Pedido::cancelaPedido($id);
        if(Pedido::cancelaPedido($id)){
            echo "Se ha eliminado el pedido numero $id con exito";
        }
      }
    }
    else{
        '<script type="text/javascript">
        alert("No ha sido posible");
        window.location.assign("login.php");
        </script>';
    }