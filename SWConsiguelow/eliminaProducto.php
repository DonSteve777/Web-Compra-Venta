<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $idProd = $_POST['delete'];
        if(isset($idProd)){
        $eliminado = Producto::eliminaById($idProd);
        if($eliminado){
            $response ='';
            $response .= <<<EOF
            <div class="alert alert-success">
        <strong>¡Pedido eliminado!</strong> Ir a<a href="login.php" class="alert-link"> login</a>.
        </div>
EOF;
        echo $response;
        }
      }
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
    