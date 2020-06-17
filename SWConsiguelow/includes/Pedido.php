<?php namespace es\fdi\ucm\aw;
//require_once __DIR__ . '/Aplicacion.php';


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

   /* public static function muestraPedidos()
     {
        $result = [];
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $user = $_SESSION['userid'];
        $query = sprintf("SELECT DISTINCT * FROM pedidos P JOIN usuarios U ON P.comprador = U.id WHERE P.comprador=$user AND P.pagado =1"); $conn->real_escape_string($user);
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
    }*/
    public static function muestraPedidos(){
    $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $user = $_SESSION['userid'];
        $query = sprintf("SELECT P.id, P.producto, P.pagado, P.comprador FROM pedidos P JOIN usuarios U ON P.comprador = U.id WHERE P.comprador=$user AND P.pagado =1"); $conn->real_escape_string($user);    $rs = $conn->query($query);
        $rs = $conn->query($query);
        $i=0;
        if ($rs) {
            if ( $rs->num_rows > 0) {
                while ($array=$rs->fetch_array()){
                    $claves = array_keys($array);
                    foreach($claves as $clave){
                        $arrayauxliar[$i][$clave]=$array[$clave];
                    }           
                    $i++;
                    $ped = $arrayauxliar;
                   
                }
                $rs->free();
                $html='';
                foreach($ped as $key => $fila){
                    $id =  $fila['id'];
                    $prod = $fila['producto'];
                    //muestraLogo($html)
                    $html.=<<<EOF
                    <ul>
                    <li> idPedido: $id</li>
                     Producto: $prod</li>
                    </ul>
EOF;
                }
            }
         }
        return $html;
    }

    public static function muestraCarrito()
  {
    $result = [];
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $user = $_SESSION['userid'];
    $query = sprintf("SELECT P.id, P.producto, P.pagado, P.comprador FROM pedidos P JOIN usuarios U ON P.comprador = U.id WHERE P.comprador=$user AND P.pagado =0"); $conn->real_escape_string($user);    $rs = $conn->query($query);
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
                echo "Borrado";
                $eliminado =true;
            }
        } else {
            echo "Error al borrar de la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $eliminado;
    }

    public static function añadePedido($id,$producto, $pagado,$comprador) //atributos pedidos
    {
        $pedido = self::buscaPedido($id);
        if ($pedido) {
            return false;
        }
        $pedido = new Pedido($producto,$pagado,$comprador);
        return self::guardaPedido($pedido);
    }
    

    public static function guardaPedido($pedido)
    {
        if ($pedido->id !== null) {
            return self::actualizaPedido($pedido);
        }
        return self::insertaPedido($pedido);
    }
    
    public static function insertaPedido($pedido)
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
            echo '<script type="text/javascript">
            alert("Se ha añadido correctamente");
            window.location.assign("index.php");
            </script>';
            exit();
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $pedido;
    }
    
	
    //filas tabla pedido
    
    private $id;

    private $producto;

    private $pagado;
    private $comprador;

	
    public function __construct($producto, $pagado, $comprador)
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