<?php
use es\fdi\ucm\aw\Pedido as Pedido;
use es\fdi\ucm\aw\Producto as Producto;


require_once __DIR__.'/includes/config.php';

$json = file_get_contents('php://input');

$dictionary = json_decode($json);
if (!is_object($dictionary)) {
    echo 'error en el json recibido';
    exit();
}  
$dictionary = json_decode($json,true);
$id = $dictionary['id'];

$pedido = Pedido::getById($id);
$idProducto = $pedido->producto();
$producto = Producto::getById($idProducto);
$precio = $producto->precio();

if(Pedido::eliminaCarrito($id)){
    echo $precio;
}
else {
    ////*echo $htmlError;*/
    echo 'error';
}

