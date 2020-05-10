<?php
namespace es\fdi\ucm\aw;

class Imagen
{
    private $id;
    private $nombre;
    private $original_name;
    private $mime_type;


    private function __construct($nombre, $original_name, $mime_type){
        $this->nombre = $nombre;
        $this->origial_name = $original_name;
        $this->mime_type = $mime_type;
    }


    private static function inserta($imagen)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        //console_log($usuario);
        $query=sprintf("INSERT INTO `usuarios` (`dni`, `nombre`, `nombreUsuario`, `password`, `direccion`, `email`, `telefono`, `ciudad`, `codigo postal`, `carrito`, `tarjeta credito`) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%i', '%i')"
            , $conn->real_escape_string($imagen->nombre)    
            , $conn->real_escape_string($imagen->original_name)
            , $conn->real_escape_string($imagen->mime_type));

        if ( $conn->query($query) ) {
            $imagen->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $imagen;
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


    public function id()
    {
        return $this->id;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    
    public function mime_type()
    {
        return $this->mime_type;
    }

    
    public function original_name()
    {
        return $this->original_name;
    }


}
