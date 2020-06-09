<?php namespace es\fdi\ucm\aw;
//require_once __DIR__ . '/Aplicacion.php';


class Pedido
{

    /*public static function muestraPedidos()
    {
        $result = [];
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $user = $_SESSION['userid'];
        $query = sprintf("SELECT * FROM pedidos P JOIN usuarios U ON P.comprador = U.id WHERE P.comprador=$user AND P.pagado =1"); $conn->real_escape_string($user);
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
                $result[] = $pedidos;
                }
            $rs->free();
        } else {
            echo "No se han encontrado pedidos asociados al usuario";
            //echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
      }

    }*/

    public static function muestraPedidos()
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
    }

    public static function muestraCarrito()
     {
        $result = [];
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $user = $_SESSION['userid'];
        $query = sprintf("SELECT DISTINCT * FROM pedidos P JOIN usuarios U ON P.comprador = U.id WHERE P.comprador=$user AND P.pagado =0"); $conn->real_escape_string($user);
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
            $pedido->idPedido= $conn->insert_id;
            echo '<script type="text/javascript">
            alert("Se ha añadido correctamente");
            window.location.assign("index.php");
            </script>';
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