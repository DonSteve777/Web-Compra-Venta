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
        '<script type="text/javascript">
        alert("No ha sido posible");
        window.location.assign("login.php");
        </script>';
    }