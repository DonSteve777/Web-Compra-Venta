<?php
namespace es\fdi\ucm\aw;

class Categoria
{
   
    public static function buscaCat($nombreCat)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM categorias c WHERE c.nombre = '%s'", $conn->real_escape_string($nombreCat));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $cat = new Categoria($fila['nombre'],$fila['descripcion']);
                $cat->id = $fila['id'];
                $result = $cat;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function findById($id)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM categorias c WHERE c.id = '%d'", $conn->real_escape_string($id));
        $rs = $conn->query($query);
       
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $cat = new Categoria($fila['nombre'],$fila['descripcion']);
                $cat->id = $fila['id'];
                $result = $cat;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function findAll()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM categorias");
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
                
            }
            $rs->free();
        } else {
            $cat = self::crea('sin categoría', 'no está catalogado en ninguna agrupación');
            $query = sprintf("SELECT * FROM categorias");
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
                }
                $rs->free();
                }
            }
            
        }
        $result = $arrayauxliar;
        return $result;
    }
    else {
        echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        exit();
    }
}

        public static function muestraCats()
        {
        $result = [];
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM categorias");
        $rs = $conn->query($query);
        if ($rs) {
            while($fila = $rs->fetch_assoc()) {
            $cat=new Categoria($fila['nombre'],$fila['descripcion']);
            $cat->id=$fila['id'];
            $result[] = $cat;
            }
            $rs->free();
        }
        return $result;
        }


    public static function crea($nombreCat,$descripcion)
    {
        $cat = self::buscaCat($nombreCat);
        if ($cat) {
            return false;
        }
        $cat = new Categoria($nombreCat,$descripcion);
        return self::guarda($cat);
    }

    public static function guarda($cat)
    {
        if ($cat->id !== null) {
            return self::actualiza($cat);
        }
        return self::inserta($cat);
    }
    

    public static function inserta($categoria)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO `categorias` (`nombre`, `descripcion`) 
        VALUES('%s','%s')"
            , $conn->real_escape_string($categoria->nombre)    
            , $conn->real_escape_string($categoria->descripcion));
        
            if ( $conn->query($query) ) {
            $categoria->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $categoria;
    }

    /*private static function actualiza($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios U SET nombre='%s', password='%s', nombreUsuario='%s',  dni='%s', direccion='%s', email='%s', telefono='%s', ciudad='%s', codigo postal='%s', carrito='%i', trajeta credito='%i'   WHERE U.id=%i"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->direccion)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->direccion)
            , $conn->real_escape_string($usuario->telefono)
            , $conn->real_escape_string($usuario->codigoPostal)
            , $conn->real_escape_string($usuario->carrito )
            , $conn->real_escape_string($usuario->tarjetaCredito )
            , $usuario->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $usuario;
    }*/


    private $id;
    private $nombre;
    private $descripcion;


    public function __construct($nombre, $descripcion){
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function id()
    {
        return $this->id;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    public function descripcion()
    {
        return $this->descripcion;
    }

    

}
