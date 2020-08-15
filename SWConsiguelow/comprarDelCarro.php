<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Pedido as Pedido;

$json = file_get_contents('php://input');
$dictionary = json_decode($json);
if (!is_object($dictionary)) {
    echo 'No se ha enviado un objeto';
    exit();
    //throw new ParametroNoValidoException('El cuerpo de la petición no es valido');
}
$dictionary = json_decode($json, true);
$idpedido = $dictionary['id'];
$pedido = Pedido::buscaPedido($idpedido);
$pedido->setPagado(1);
Pedido::actualiza($pedido);

