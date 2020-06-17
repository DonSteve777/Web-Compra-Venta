<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $idproducto = $_GET['id'];
        $pagado = $_GET['pagado'];
        $comprador = $_SESSION['userid'];
        $pedido = new Pedido($idproducto, $pagado, $comprador);
        //Pedido::añadePedido($id,$idproducto, $pagado, $comprador);
        Pedido::insertaPedido($pedido);
        /*$pedido = new Pedido($idproducto, $pagado, $comprador);
        Pedido::añadePedido($pedido->id(),$producto, $pagado,$comprador);*/

    }
    else{
        echo '<script type="text/javascript">
        alert("No has hecho login, se te mandará a login");
        window.location.assign("login.php");
        </script>';
    }
    
