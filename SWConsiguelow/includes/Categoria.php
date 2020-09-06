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

    public static function getById($id)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM categorias c WHERE c.id = '%d'", $conn->real_escape_string($id));
        $rs = $conn->query($query);
        $result = null;
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

    public static function getAll()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM categorias");
        $rs = $conn->query($query);
        $result = [];
        $rs = $conn->query($query);
        if ($rs) {
            if ( $rs->num_rows > 0) {
                while($fila = $rs->fetch_assoc()) {
                    $result[]=new Categoria($fila['nombre'],$fila['descripcion'], $fila['id']);
                }
                $rs->free();
            } else {
                $result= 'No se ha cargado ninguna categoría';
            } 
        }else{
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        } 
        return $result;
    }

    public static function getNotEmpties()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT DISTINCT  categorias.id, categorias.descripcion, categorias.nombre FROM categorias INNER JOIN productos ON categorias.id=productos.categoria");
        $rs = $conn->query($query);
        $result = [];
        $rs = $conn->query($query);
        if ($rs) {
            if ( $rs->num_rows > 0) {
                while($fila = $rs->fetch_assoc()) {
                    $result[]=new Categoria($fila['nombre'],$fila['descripcion'], $fila['id']);
                }
                $rs->free();
            } else {
                $result = 'No se ha cargado ninguna categoría';
            } 
        }else{
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        } 
        return $result;
    }
      
        public static function eliminaCat($cat){
            $cat = self::getById($cat); 
            if (!$cat) {
                return "No se ha encontrado cat";
            }
            else{ 
           return self::elimina($cat); 
            }
        }
    
        private static function elimina($cat) 
        {
            $eliminado = false;
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $id = $cat->id; 
            $query=sprintf("DELETE FROM categorias WHERE id ='$id'",$conn->real_escape_string($id));
            if ( $conn->query($query) ) {
                if ( $conn->affected_rows != 1) {
                    echo "No se ha podido borrar la categoria: " . $cat->nombre;
                    exit();
                }
                elseif ($conn->affected_rows == 1){
                    echo "Categoria $cat->nombre  borrada con exito ;) ";
                    $eliminado =true;
                }
            } else {
                echo "Error al borrar de la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            }
            return $eliminado;
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



    private $id;
    private $nombre;
    private $descripcion;


    public function __construct($nombre, $descripcion, $id = NULL){
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id = $id;
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
