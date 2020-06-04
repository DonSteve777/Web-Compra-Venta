<?php
namespace es\fdi\ucm\aw;

class Imagen
{
    private $id;
    private $nombre;
   // private $original_name;
    private $mime_type;


    public function __construct($productId, $nombre, $mime_type){
        $this->productId = $productId;
        $this->nombre = $nombre;
        $this->mime_type = $mime_type;
    }

    


    public static function inserta($imagen)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO `uploads` (`producto`, `name`, `mime_type`) VALUES('%d', '%s', '%s')"
            , $conn->real_escape_string($imagen->productId)    
            , $conn->real_escape_string($imagen->nombre)    
            , $conn->real_escape_string($imagen->mime_type));

        if ( $conn->query($query) ) {
            $imagen->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $imagen;
    }


    public static function findByProductId($productid)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM uploads U WHERE U.producto = '%d'", $conn->real_escape_string($productid));
        $rs = $conn->query($query);
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $img = new Imagen($fila['producto'], $fila['name'], $fila['mime_type']);
                $img->id = $fila['id'];
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $img;
    }



    public function id()
    {
        return $this->id;
    }

    public function productid()
    {
        return $this->productid;
    }


    public function nombre()
    {
        return $this->nombre;
    }

    
    public function mime_type()
    {
        return $this->mime_type;
    }

    

}
