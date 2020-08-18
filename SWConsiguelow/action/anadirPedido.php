<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Pedido as Pedido;
alert('llego');
/*

    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $entityBody = file_get_contents('php://input');
        $dictionary = json_decode($entityBody);
        if (!is_object($dictionary)) {
            echo 'No se ha enviado un objeto';
            exit();
            //throw new ParametroNoValidoException('El cuerpo de la petición no es valido');
        }
        $dictionary = json_decode($entityBody, true);
        $idproducto = $dictionary['producto'];
        $pagado = $dictionary['pagado'];
        $comprador = $_SESSION['userid'];
        $pedido = new Pedido($idproducto, $pagado, $comprador);

        if (Pedido::pedidoProducto($pedido)){
            http_response_code(201); // 201 Created
            $response = '';
            if ( $pagado==0){
                $response=<<<EOF
                <a href="vistaCarrito.php" id="viewCart" type="button" class="btn btn-info btn-lg">Ver carrito</a>
            EOF;
            }

            header('Content-Type: application/html; charset=utf-8');
            header('Content-Length: ' . mb_strlen($response));
            echo $response;
        }  
    }*/
    //else: mandar a login
    
