<?php
use es\fdi\ucm\aw\Pedido as Pedido;
use es\fdi\ucm\aw\Producto as Producto;


require_once __DIR__.'/includes/config.php';
if (!($_SERVER['REQUEST_METHOD']=='POST')){
    echo 'error1';// Se esperaba un petición POST.';
    die();
}
else{
    $json = file_get_contents('php://input');
    $dictionary = json_decode($json);
    if (!is_object($dictionary)) {
        echo 'error2';// en el json recibido';
        die();
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
        echo 'error3';  //error al eliminar
    }
}


