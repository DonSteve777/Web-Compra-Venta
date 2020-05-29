<?php namespace es\fdi\ucm\aw;
//require_once __DIR__ . '/Aplicacion.php';


class Producto
{


    /*public static function buscaProducto($nombreProd)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM productos P WHERE P.nombre = '%s'", $conn->real_escape_string($nombreProd));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $producto = new Producto($fila['nombre'], $fila['descripcion'], $fila['precio'],$fila['unidades'], $fila['unidadesDisponibles'],$fila['tallasDisponibles'],$fila['coloresDisponibles'],$fila['talla'],$fila['color'],$fila['categoria'],$fila['reseña'],$fila['agotado'],$fila['numEstrellas'],$fila['imagen']);
                $producto->id = $fila['id'];
                $result = $producto;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }*/

    public static function muestraProds(){ //funcion que muestra todos los productos disponibles
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM productos P");
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
                $prod = $arrayauxliar;
                $result = $prod;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
}

    public static function muestraProductosPorNombre($nombreProd)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $nombreProd = $_POST['nombre'];
        $query = sprintf("SELECT * FROM productos P WHERE P.nombre = '$nombreProd'");$conn->real_escape_string($nombreProd);
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
                $prod = $arrayauxliar;
                $result = $prod;
                }
            $rs->free();
            }   
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function muestraProductosPorCat($nombreCat){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM productos P WHERE P.categoria = '$nombreCat'");$conn->real_escape_string($nombreCat);
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
                $prod = $arrayauxliar;
                $result = $prod;
                }
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }



    public static function muestraProductosPorPrecioDesc($producto)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM productos P ORDER BY P.precio DESC"); $conn->real_escape_string($producto);
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
                $prod = $arrayauxliar;
                $result = $prod;
                }
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }


    public static function añadeProd($nombreProd, $vendedor, $descripcion, $precio,$unidades,$talla,$color,$categoria) //atributos productos
    {
       /* $producto = self::buscaProducto($nombreProd);
        if ($producto) {
            return false;
        }*/
        $producto = new Producto($nombreProd, $vendedor, $descripcion, $precio,$unidades, $talla, $color, $categoria);
        return self::guardaProd($producto);
    }
    

    public static function guardaProd($producto)
    {
        if ($producto->id !== null) {
            return self::actualizaProd($producto);
        }
        return self::insertaProd($producto);
    }

    private static function insertaProd($producto)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO `productos`  (`nombre`, `idVendedor`, `descripcion`,`precio`,`unidades`, `talla`, `color`, `categoria`) 
		 VALUES('%s','%d', '%s', '%f', '%d', '%s', '%s', '%s')"
            , $conn->real_escape_string($producto->nombre)
            , $conn->real_escape_string($producto->vendedor)
            , $conn->real_escape_string($producto->descripcion)
            , $conn->real_escape_string($producto->precio)
            , $conn->real_escape_string($producto->unidades)
			, $conn->real_escape_string($producto->talla)
			, $conn->real_escape_string($producto->color)
			, $conn->real_escape_string($producto->categoria));

        if ( $conn->query($query) ) {
            $producto->id = $conn->insert_id;
     
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $producto;
    }
    
    /*private static function actualizaProd($producto)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Productos P SET nombre = '%s', descripcion='%s', precio='%f', unidades='%d, unidadesDisponibles ='%d', tallasDisponibles ='%s', coloresDisponibles ='%s', talla ='%s', color ='%s', categoria ='%s', reseña ='%s', agotado ='%b', numEstrellas ='%d', imagen ='%s' WHERE P.id=%i"
            , $conn->real_escape_string($producto->nombre)
            , $conn->real_escape_string($producto->descripcion)
            , $conn->real_escape_string($producto->precio)
            , $conn->real_escape_string($producto->unidades)
            , $conn->real_escape_string($producto->unidadesDisponibles)
            , $conn->real_escape_string($producto->tallasDisponibles)
            , $conn->real_escape_string($producto->coloresDisponibles)
            , $conn->real_escape_string($producto->talla)
            , $conn->real_escape_string($producto->color)
            , $conn->real_escape_string($producto->categoria)
            , $conn->real_escape_string($producto->reseña)
            , $conn->real_escape_string($producto->agotado)
            , $conn->real_escape_string($producto->numEstrellas)
            , $conn->real_escape_string($producto->imagen)
            , $producto->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el producto: " . $producto->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $producto;
    }*/
	
	//filas tabla productos
    private $id;

    private $nombre;

    private $vendedor;

    private $descripcion;

    private $precio;
	
    private $talla;
	
    private $color;
	
    private $categoria;

    private $unidades;

    private function __construct($nombreProd, $vendedor, $descripcion, $precio,$unidades, $talla, $color, $categoria)
    {
        $this->nombre = $nombreProd;
        $this->vendedor = $vendedor;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->unidades = $unidades;
        $this->talla = $talla;
        $this->color = $color;
		$this->categoria= $categoria;
    }


    public function id()
    {
        return $this->id;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    
    public function vendedor()
    {
        return $this->vendedor;
    }

	public function descripcion()
    {
        return $this->descripcion;
    }

	public function unidades()
    {
        return $this->unidades;
    }
    public function precio()
    {
        return $this->precio;
    }

    public function talla()
    {
        return $this->talla;
    }
    
    public function categoria()
    {
        return $this->categoria;
    }


    public function color()
    {
        return $this->color;
    }
}