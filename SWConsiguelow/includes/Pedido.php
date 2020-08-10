<?php namespace es\fdi\ucm\aw;

class Pedido
{

    public static function buscaPedido($id)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM pedidos P WHERE P.id = '%s' AND P.pagado=1", $conn->real_escape_string($id));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $pedido = new Pedido($fila['producto'], $fila['pagado'], $fila['comprador']);
                $pedido->id = $fila['id'];
                $result = $pedido;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaCarrito($id)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM pedidos P WHERE P.id = '%s' AND P.pagado = 0", $conn->real_escape_string($id));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $pedido = new Pedido($fila['producto'], $fila['pagado'], $fila['comprador']);
                $pedido->id = $fila['id'];
                $result = $pedido;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function getByUser($user)
     {
        $result = [];
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT P.id, P.producto, P.pagado, P.comprador FROM pedidos P JOIN usuarios U ON P.comprador = U.id WHERE P.comprador=$user AND P.pagado =1"); $conn->real_escape_string($user);    $rs = $conn->query($query);
        $rs = $conn->query($query);
        if ($rs) {
            while($fila = $rs->fetch_assoc()) {
            $ped=new Pedido($fila['producto'],$fila['pagado'],$fila['comprador']);
            $ped->id=$fila['id'];
            $result[] = $ped;
            }
            $rs->free();
        }
        return $result;
    }


    public static function getCarrito()
  {
    $result = [];
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $user = $_SESSION['userid'];
    $query = sprintf("SELECT * FROM pedidos P JOIN usuarios U ON P.comprador = U.id WHERE P.comprador=$user AND P.pagado =0"); 
    $conn->real_escape_string($user);    
    $rs = $conn->query($query);
    if ($rs) {
      while($fila = $rs->fetch_assoc()) {
        $ped=new Pedido($fila['producto'],$fila['pagado'],$fila['comprador']);
        $ped->id=$fila['id'];
        $result[] = $ped;
      }
      $rs->free();
    }
    return $result;
  }


    public static function eliminaCarrito($id){
        $cart = self::buscaCarrito($id); 
        if (!$cart) {
            $html="No";
        }
        else{ 
       return self::elimina($cart); 
        }
    }

    public static function cancelaPedido($id){
        $pedido = self::buscaPedido($id); 
        $html = 'No';
        if (!$pedido) {
            return $html;
        }
        else{ 
       return self::cancela($pedido); 
        }
    }

    private static function elimina($cart) 
    {
        $eliminado = false;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $id = $cart->id; 
        $query=sprintf("DELETE FROM pedidos WHERE id ='$id'",$conn->real_escape_string($id));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido borrar del carrito: " . $cart->producto;
                exit();
            }
            elseif ($conn->affected_rows == 1){
                $eliminado =true;
            }
        } else {
            echo "Error al borrar de la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $eliminado;
    }

    private static function cancela($pedido) 
    {
        $eliminado = false;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $id = $pedido->id; 
        $query=sprintf("DELETE FROM pedidos WHERE id ='$id'",$conn->real_escape_string($id));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido cancelar el pedido: " . $id;
                exit();
            }
            elseif ($conn->affected_rows == 1){
                $eliminado =true;
            }
        } else {
            echo "Error al borrar de la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $eliminado;
    }

    public static function pedidoProducto($pedido){
        $carro = self::getCarrito();
        $i=0;
        $encontrado = false;
        $size =  count($carro);
        while($i < $size && !$encontrado){
            $encontrado = ($carro[$i]==$pedido->producto()) ? true : false;
            $i++;
        }
        if ($encontrado)
            return false;
        else{
            return self::inserta($pedido);
        }
    }

    public static function guardaPedido($pedido)
    {
        if ($pedido->id !== null) {
            return self::actualizaPedido($pedido);
        }
        return self::inserta($pedido);
    }
    
    public static function inserta($pedido)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO `pedidos` (`producto`,`pagado`, `comprador`) 
		 VALUES('%d', '%d', '%d')"
            , $conn->real_escape_string($pedido->producto)
            , $conn->real_escape_string($pedido->pagado)
            , $conn->real_escape_string($pedido->comprador)
        );
        if ( $conn->query($query) ) {
            $pedido->id= $conn->insert_id;
    
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $pedido;
    }

    public static function contadorCarrito()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT * FROM `pedidos` WHERE 'comprado'= '0' ");
        $rs =  $conn->query($query);
        if ( $rs ) {
            return $rs->num_rows; 
            /*echo '<script type="text/javascript">
            alert("Se ha añadido correctamente");
            window.location.assign("index.php");
            </script>';
            exit();*/
        } else {
            echo "Error al consultar la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
    }




    private $id;

    private $producto;

    private $pagado;
    private $comprador;

	
    public function __construct($producto, $pagado, $comprador, $id=NULL)
    {
        $this->pagado = $pagado;
        $this->producto = $producto;
        $this->comprador = $comprador;
    }

    public function id()
    {
        return $this->id;
    }

    public function pagado()
    {
        return $this->pagado;
    }
    
    public function producto()
    {
        return $this->producto; 
    }

    public function comprador()
    {
        return $this->comprador; 
    }

}