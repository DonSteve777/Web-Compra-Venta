<?php namespace es\fdi\ucm\aw;
//require_once __DIR__ . '/Aplicacion.php';


class Producto
{
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
                }
                $rs->free();
                $html='';
                foreach($prod as $key => $fila){
                    $id =  $fila['id'];
                    $imgSrc = ImageUpload::getSource($id);
                    $descripcion = $fila['descripcion'];
                    $precio= $fila['precio'];
                    $categoria = Categoria::findById($fila['categoria'])->nombre();
                    $nombre = $fila['nombre'];
                    //muestraLogo($html)
                    $html.=<<<EOF
                    <ul>
                    <li>idProducto: $id</li>
                        <li> Nombre Producto: $nombre</li>
                        <li>Descripcion: $descripcion</li>
                        <li>Precio: $precio</li>
                        <li>Categoria: $categoria</li>
                        <li>$imgSrc</li>
                        <a href="anadirPedido.php?id=$id&pagado=0">
                        <button type="button" id="addCart" >
                            Añadir al carrito</a>
                            </button></a>
                        <a href="anadirPedido.php?id=$id&pagado=1">
                        <button type="button" id="addCart">
                            Comprar</a>
                            </button></a>
                    </ul>
EOF;
                }
            } else {
                $html='';
                $html =  <<<EOF
    <div class="logo">
        <img src="img/logo.gif" alt="imagen no disponible">
    </div>
    EOF;   
        } 
    }else{
        echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        exit();
    
    } 
    return $html;
}

public static function findById($id){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM productos U WHERE U.id = '%d'", $conn->real_escape_string($id));
    $rs = $conn->query($query);
    if ($rs) {
        if ( $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $prod=new Producto($fila['nombre'], $fila['idVendedor'], $fila['descripcion'], $fila['precio'], $fila['unidades'],$fila['talla'],$fila['color'],$fila['categoria']);
            $prod->id = $id;
            
        }
        $rs->free();
    } else {
        echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        exit();
    }
    return $prod;
}

public static function muestraCards(){
    $html='';
    $prods = self::cargaProds();
    $html = self::allCardsProduct($prods);
    return $html;
}


public static function muestraCardsCat($id){
    $html='';
    $prods = self::productosPorCat($id);
    $html = self::allCardsProduct($prods);
    return $html;
}

public static function cargaProds(){ //funcion que muestra todos los productos disponibles
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $currentuser= $_SESSION['userid'];
    $query = sprintf("SELECT * FROM productos P WHERE NOT idVendedor=%d"
    , $conn->real_escape_string($currentuser));

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
               
            }
            $rs->free();
        } else {
            echo "No se ha cargado ningún producto";
        } 
    }else{
        echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        exit();
    } 
    return $prod;
}

public static function allCardsProduct($prod=array()){ 
    $html = '';
    $currentuser= $_SESSION['userid'];
    //var_dump($currentuser);
    if (is_array($prod)){
        foreach($prod as $key => $fila){
            $vendedor = $fila['idVendedor'];
    
            if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
                if ($vendedor!==$currentuser) {
                    $id =  $fila['id'];
                    $imgSrc = ImageUpload::getSource($id);
                    $precio= $fila['precio'];
                    $html .= self::cardProduct($precio, $imgSrc, $id); 
                }
            }
            else{
                $id =  $fila['id'];
                $imgSrc = ImageUpload::getSource($id);
                $precio= $fila['precio'];
                $html .=<<<EOF
                    <div class="col-md-4">
    EOF;
                $html .= self::cardProduct($precio, $imgSrc, $id);
                $html .=<<<EOF
                    </div>
    EOF;
            }
        }
    }
    return $html;
}


private static function cardProduct($precio, $imgSrc, $id){ 
    $html=<<<EOF
    <div class="card mb-4 text-center bg-light border-0">
        <div class="card-img-top">
            <a href="producto.php?id=$id">
                <img class="img-thumbnail" src=$imgSrc alt="imagen no disponible" >
            </a>
        </div>
        <div class="card-body justify-content-end"> 
            $precio €
        </div>
    </div>
EOF;
    return $html;
}



public static function muestraProdsUsuario($idUsuario){ //funcion que muestra todos los productos disponibles
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM productos P WHERE P.idVendedor =$idUsuario");$conn->real_escape_string($idUsuario);
    $rs = $conn->query($query);
    $result = false;
    $i=0;
    $html='';
    if ($rs) {
        if ( $rs->num_rows > 0) {
            while ($array=$rs->fetch_array()){
                $claves = array_keys($array);
                foreach($claves as $clave){
                    $arrayauxliar[$i][$clave]=$array[$clave];
                }           
                $i++;
                $prod = $arrayauxliar;
               
            }
            $rs->free();
            
            $html.=<<<EOF
            <ul class="list-group">
EOF;
            foreach($prod as $key => $fila){
                $id =  $fila['id'];
                $imgSrc = ImageUpload::getSource($id);
                $descripcion = $fila['descripcion'];
                $precio= $fila['precio'];
                $categoria = Categoria::findById($fila['categoria'])->nombre();
                $nombre = $fila['nombre'];
                $html.=<<<EOF
                    <li class="list-group-item">
                        <div class="d-flex flex-row">
                            <div style="height: 200px;">
                                <img class="h-50"  src=$imgSrc alt="no disponible">    
                            </div>
                            <div class="p-2 m-3 flex-fill">
                                <p>Producto: $nombre</p>
                                <p>Descripción: $descripcion</p>
                                <p>Precio: $precio €</p>
                                <p>Categoria: $categoria</p>
                            </div>
                            <div class="d-flex flex-wrap align-content-center">
                            <a class="text-center btn btn-info" href="eliminaProducto.php?nombreProd=$nombre">
                                Quitar</a>
                        </div>
                    </li>     
    EOF;
            }
            $html.=<<<EOF
            </ul>
EOF;

        } else {
            $html='';
            $html =  <<<EOF
            <p>Aun no has subido ningun producto, anímate a <a href='vender.php'>subir algo.</p>
EOF;
     
    } 

  
}else{

    echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
    exit();

} 
return $html;
}



    public static function buscaProd($nombreProd)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM productos P WHERE P.nombre = '%s'", $conn->real_escape_string($nombreProd));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $prod=new Producto($fila['nombre'], $fila['idVendedor'], $fila['descripcion'], $fila['precio'], $fila['unidades'],$fila['talla'],$fila['color'],$fila['categoria']);
                $prod->id = $fila['id'];
                $result = $prod;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function eliminaProd($nombreProd){
        $prod = self::buscaProd($nombreProd); 
        if (!$prod) {
            return "No se ha encontrado nada";
        }
        else{ 
       return self::elimina($prod); 
        }
    }

    private static function elimina($prod)
    {
        $eliminado = false;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $id = $prod->id; 
        $query=sprintf("DELETE FROM productos WHERE id ='$id'",$conn->real_escape_string($id));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido borrar la categoria: " . $prod->nombre;
                exit();
            }
            elseif ($conn->affected_rows == 1){
                echo "Categoria. $prod->nombre . borrado";
                $eliminado =true;
            }
        } else {
            echo "Error al borrar de la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $eliminado;
    }

    public static function muestraProdPorNombre($nombreProd = NULL)
  {
    $result = [];
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM productos P WHERE P.nombre LIKE '$nombreProd'");
    $conn->real_escape_string($nombreProd);
    $rs = $conn->query($query);
    if ($rs) {
      while($fila = $rs->fetch_assoc()) {
        $prod=new Producto($fila['nombre'], $fila['idVendedor'], $fila['descripcion'], $fila['precio'], $fila['unidades'],$fila['talla'],$fila['color'],$fila['categoria']);
        $prod->id=$fila['id'];
        $result[] = $prod;
      }
      $rs->free();
    }
    return $result;
  }

    public static function productosPorCat($idCat){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM productos P WHERE P.categoria = '$idCat'");$conn->real_escape_string($idCat);
        $rs = $conn->query($query);
        $prod=array();
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
                }
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $prod;
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
        $producto = self::buscaProd($nombreProd);
        if ($producto) {
            return false;
        }
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