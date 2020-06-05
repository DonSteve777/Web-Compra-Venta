<?php namespace es\fdi\ucm\aw;
//require_once __DIR__ . '/Aplicacion.php';


class Pedido
{

    


    public static function muestraPedidos()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $user = $_SESSION['userid'];
        //$query = sprintf("SELECT * FROM Pedidos pd JOIN Usuarios u ON u.id = pd.idCliente"); $conn->real_escape_string($user);
        $query = sprintf("SELECT * FROM pedidos P JOIN usuarios U ON P.idCliente = U.id"); $conn->real_escape_string($user);
        $rs = $conn->query($query);
        $result = false;
        $i=0;
        if ($rs) {
            if ( $rs->num_rows > 0) {
                while ($array=$rs->fetch_array()){
                $claves = array_keys($array);
                foreach($claves as $clave){
                    $arrayauxliar[$i][$clave]=$array[$clave];
                }           
                $i++;
                $pedidos = $arrayauxliar;
                $result = $pedidos;
                }
            $rs->free();
        } else {
            echo "No se han encontrado pedidos asociados al usuario";
            //echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
      }

    }

    public static function añadePedido($nombrePedido,$fecha, $idProd, $idCliente,$nombreProd, $pagado) //atributos pedidos
    {
        $pedido = self::buscaPedido($nombrePedido);
        if ($pedido) {
            return false;
        }
        $pedido = new Pedido($fecha, $idProd, $idCliente,$nombreProd,$pagado);
        return self::guardaPedido($pedido);
    }
    

    public static function guardaPedido($pedido)
    {
        if ($pedido->idPedido !== null) {
            return self::actualizaPedido($pedido);
        }
        return self::insertaPedido($pedido);
    }
    
    private static function insertaPedido($pedido)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO `pedidos` (`producto`,`pagado`) 
		 VALUES('%d', '%d')"
            , $conn->real_escape_string($pedido->producto)
            , $conn->real_escape_string($pedido->pagado));
        if ( $conn->query($query) ) {
            $pedido->idPedido= $conn->insert_id;
            echo "pedido añadido con exito";
            exit();
           // $pedido->idVendedor = $conn->id;
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

	
    private function __construct($producto, $pagado)
    {

        $this->pagado = $pagado;
        $this->producto = $producto;
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

}