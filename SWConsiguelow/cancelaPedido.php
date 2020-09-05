<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $id = $_POST['item'];
        if(isset($id)){
            $response ='';
            $cancelado = Pedido::cancelaPedido($id);
            if($cancelado){
            // if (!is_null($guardado)){
                $response .= <<<EOF
                <div class="alert alert-success text-center" role="alert">
                        <strong>Pedido eliminado!</strong> 
                </div>
EOF;
            }
            else {
                $response .= "No ha sido posible";
            }
        }
        echo $response;
    }
    else{
        $html ='';
        $html.= <<<EOF
        <div class="alert alert-info">
        <strong>¡No has iniciado sesion!</strong> Deberias <a href="login.php" class="alert-link">ir a login</a>.
        </div>
EOF;
        echo $html;
    }