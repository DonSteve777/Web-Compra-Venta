<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';

    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $entityBody = file_get_contents('php://input');
        $dictionary = json_decode($entityBody);
        if (!is_object($dictionary)) {
            echo 'No se ha enviado un objeto';
            exit();
            //throw new ParametroNoValidoException('El cuerpo de la petición no es valido');
        }
        $dictionary = json_decode($entityBody, true);
        $idproducto = $dictionary['id'];
        var_dump($idproducto);
        $pagado = $dictionary['pagado'];
        var_dump($pagado);

        $comprador = $_SESSION['userid'];
        var_dump( $comprador);
        $pedido = new Pedido($idproducto, $pagado, $comprador);
        //Pedido::añadePedido($id,$idproducto, $pagado, $comprador);
        Pedido::insertaPedido($pedido);
        http_response_code(201); // 201 Created

        /*$pedido = new Pedido($idproducto, $pagado, $comprador);
        Pedido::añadePedido($pedido->id(),$producto, $pagado,$comprador);*/
    }
    else{
        echo '<!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCentered">
          Launch centered demo modal
        </button>
        
        <!-- Modal -->
        <div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        ';
    }
    
