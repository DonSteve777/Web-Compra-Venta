<?php namespace es\fdi\ucm\aw;
//require_once __DIR__ . '/Aplicacion.php';


class Producto
{


    public static function buscaProducto($nombreProd)
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
                /*if($producto->unidadesDisponibles>0){
                    $producto->agotado = false;
                }
                else{
                    $producto->agotado=true;
                }*/
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function muestraProductos()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM productos P"); //$conn->real_escape_string($producto);
        $rs = $conn->query($query);
        $result = false;
        ?>
        <centre>
        <table>
        <thead>
            <tr>
                 <th>Imagen</th>
                 <th>Nombre</th>
                 <th>Descripcion</th>
                 <th>Precio</th>
                 <th>Unidades</th>
                 <th>Talla</th>
                 <th>Color</th>
                 <th>Categoria</th>
                 <th>Reseña</th>
                 <th>Agotado</th>
                 <th>Numero Estrellas</th>
            </tr>
        </thead>
        <tbody>
         <?php
        if ($rs) {
           // if ( $rs->num_rows >= 1) {
               while( $fila = $rs->fetch_assoc()){
                ?>
        <tr>
        <td><img src="<?php echo $fila['imagen']; ?>" width='85' height='85'/></td>
        <td><?php echo $fila['nombre']; ?></td>
        <td><?php echo $fila['descripcion']; ?></td>
        <td><?php echo $fila['precio']; ?></td>
        <td><?php echo $fila['unidadesDisponibles'];?></td>
        <td><?php echo $fila['talla']; ?></td>
        <td><?php echo $fila['color']; ?></td>
        <td><?php echo $fila['categoria']; ?></td>
        <td><?php echo $fila['reseña']; ?></td>
        <td><?php echo $fila['agotado']; ?></td>
        <td><?php echo $fila['numEstrellas']; ?></td>
        </tr>
        <?php
            }
        ?>
            </tbody>
            </table>
            </centre>
            <?php
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function muestraProductosPorNombre()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $nombreProd = $_POST['nombre'];
        $query = sprintf("SELECT * FROM productos P WHERE p.nombre = '$nombreProd'");$conn->real_escape_string($nombreProd);
        $rs = $conn->query($query);
        $result = false;
        ?>
        <centre>
        <table>
        <thead>
            <tr>
                 <th>Imagen</th>
                 <th>Nombre</th>
                 <th>Descripcion</th>
                 <th>Precio</th>
                 <th>Unidades</th>
                 <th>Talla</th>
                 <th>Color</th>
                 <th>Categoria</th>
                 <th>Reseña</th>
                 <th>Agotado</th>
                 <th>Numero Estrellas</th>
            </tr>
        </thead>
        <tbody>
         <?php
        if ($rs) {
           // if ( $rs->num_rows >= 1) {
               while( $fila = $rs->fetch_assoc()){
                ?>
        <tr>
        <td><img src="<?php echo $fila['imagen']; ?>" width='85' height='85'/></td>
        <td><?php echo $fila['nombre']; ?></td>
        <td><?php echo $fila['descripcion']; ?></td>
        <td><?php echo $fila['precio']; ?></td>
        <td><?php echo $fila['talla']; ?></td>
        <td><?php echo $fila['color']; ?></td>
        <td><?php echo $fila['categoria']; ?></td>
 
        </tr>
        <?php
            }
        ?>
            </tbody>
            </table>
            </centre>
            <?php
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
        ?>
        <centre>
        <table>
        <thead>
            <tr>
                 <th>Imagen</th>
                 <th>Nombre</th>
                 <th>Descripcion</th>
                 <th>Precio</th>
                 <th>Unidades</th>
                 <th>Talla</th>
                 <th>Color</th>
                 <th>Categoria</th>
                 <th>Reseña</th>
                 <th>Agotado</th>
                 <th>Numero Estrellas</th>
            </tr>
        </thead>
        <tbody>
         <?php
        if ($rs) {
           // if ( $rs->num_rows >= 1) {
               while( $fila = $rs->fetch_assoc()){
                ?>
        <tr>
        <td><img src="<?php echo $fila['imagen']; ?>" width='85' height='85' /></td>
         <!-- <td><img height="50px" src="data:image/jpeg;base64,<?php echo base64_encode($fila['imagen']); ?>"/></td>muestro la imagen-->
        <td><?php echo $fila['nombre']; ?></td>
        <td><?php echo $fila['descripcion']; ?></td>
        <td><?php echo $fila['precio']; ?></td>
        <td><?php echo $fila['talla']; ?></td>
        <td><?php echo $fila['color']; ?></td>
        <td><?php echo $fila['categoria']; ?></td>

        </tr>
        <?php
            }
        ?>
            </tbody>
            </table>
            </centre>
            <?php
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
        var_dump($producto->vendedor);
        $query=sprintf("INSERT INTO `productos`  (`nombre`, `idVendedor`, `descripcion`,`precio`,`unidades`, `talla`, `color`, `categoria`) 
		 VALUES('%s','%i', '%s', '%f', '%d', '%s', '%s', '%s')"
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
            var_dump($producto->id);
     
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $producto;
    }
    
   /* private static function actualizaProd($producto)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE productos P SET nombre = '%s', descripcion='%s', precio='%f', unidades='%d, talla ='%s', color ='%s', categoria ='%s', imagen ='%s' WHERE P.id=%i"
            , $conn->real_escape_string($producto->nombre)
            , $conn->real_escape_string($producto->descripcion)
            , $conn->real_escape_string($producto->precio)
            , $conn->real_escape_string($producto->unidades)
            , $conn->real_escape_string($producto->talla)
            , $conn->real_escape_string($producto->color)
            , $conn->real_escape_string($producto->categoria)

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