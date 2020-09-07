<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Pedido;

if (!($_SERVER['REQUEST_METHOD']=='POST')){
    echo 'error1';// Se esperaba un petición POST.';
    die();
}
else{
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $entityBody = file_get_contents('php://input');
        $dictionary = json_decode($entityBody);
        if (!is_object($dictionary)) {
            echo 'error2';//No se ha enviado un objeto';
            die();
            //throw new ParametroNoValidoException('El cuerpo de la petición no es valido');
        }
        $dictionary = json_decode($entityBody, true);
        $idproducto = $dictionary['producto'];
        $pagado = $dictionary['pagado'];
        $comprador = $_SESSION['userid'];
        $pedido = new Pedido($idproducto, $pagado, $comprador);
        $response = '';
        //añadir al carro->pagado es 0
        if ($pagado==0){
            if (Pedido::inserta($pedido)){
                http_response_code(201); // 201 Created
                $response=<<<EOF
                <a href="carro.php" id="viewCart" type="button" class="btn btn-info btn-lg">Ver carrito</a>
EOF;
                 header('Content-Type: application/html; charset=utf-8');
                 header('Content-Length: ' . mb_strlen($response));
                 
             }  
             else{
                 $response=<<<EOF
                 <p> Error en la operación de guardado del pedido</p>
EOF; 
             }
        }
        //distinción entre compra directa (insertar pedido), y compra de un producto del carrito (buscar y actualizar)
        else{
            $carrito = Pedido::getCarrito();
            $guardado = NULL;
            $i=0;
            $encontrado = false;
            $response='';
            while($i < count($carrito) && !$encontrado){
                if ($carrito[$i]->producto() ==  $idproducto) $encontrado = true;
                else
                    $i++;
            }
            if ($encontrado){
                $pedido->setId($carrito[$i]->id());
            }
           $guardado = Pedido::guarda($pedido);
           if (!is_null($guardado)){
            $response = <<<EOF
            <div class="alert alert-success text-center" role="alert">
                <strong>Genial!</strong> Compra confirmada
            </div>
EOF;
            }
        }
        echo $response;
    }
}
    
    
