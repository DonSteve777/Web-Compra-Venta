<?php
namespace es\fdi\ucm\aw\usuarios;
use es\fdi\ucm\aw\Aplicacion as App;

class Usuario
{

    public static function getAll(){ 
        throw new UsuarioNoEncontradoException("No se encuentran usuarios");
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios P");
        $rs = $conn->query($query);
        $i=0;
        $users=array();
        if ($rs && $rs->num_rows > 1) {
                while ($array=$rs->fetch_array()){
                    $claves = array_keys($array);
                    foreach($claves as $clave){
                        $users[$i][$clave]=$array[$clave];
                    }           
                    $i++;
                }
                $rs->free();
        }else{
            error_log( "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error));
            throw new UsuarioNoEncontradoException("No se encuentran usuarios");
        }
        return $users;
    }


    public static function login($nombreUsuario, $password)
  {
    $user = self::buscaUsuario($nombreUsuario);
    if (!$user) {
        throw new UsuarioNoEncontradoException("No se puede encontrar al usuario: $username");    
      }
      if (!$user->compruebaPassword($password)) {
        return false;
      }
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT R.nombre FROM rolesUsuario RU, roles R WHERE RU.rol = R.id AND RU.usuario=%s", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) { 
          $user->addRol($fila['nombre']);
        }
        $rs->free();
      }
      return $user;    
  }

    public static function buscaUsuario($nombreUsuario)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombre'], $fila['nombreUsuario'], $fila['password'], $fila['dni'],  $fila['direccion'],  $fila['email'],  $fila['telefono'],  $fila['ciudad'],  $fila['codigo postal'],  $fila['carrito'], $fila['tarjeta credito'] );
                $user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function crea($nombre, $nombreUsuario, $password,  $dni, $direccion, $email, $telefono, $ciudad, $codigoPostal, $tarjetaCredito)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user) {
            return false;
        }
        $user = new Usuario($nombre, $nombreUsuario, self::hashPassword($password),  $dni, $direccion, $email, $telefono, $ciudad, $codigoPostal, $tarjetaCredito);
        return self::guarda($user);
    }
    

    public static function muestraInfo($usuario){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario = '$usuario'", $conn->real_escape_string($usuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $array[0]['usuario'] = $fila['nombreUsuario'];
                $array[0]['nombre'] = $fila['nombre'];
                $array[0]['direccion'] = $fila['direccion'];
                $array[0]['telefono'] = $fila['telefono'];
                $array[0]['email'] = $fila['email'];
                $array[0]['cp'] = $fila['codigo postal'];
                $array[0]['ciudad'] = $fila['ciudad'];
                $user= $array;
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function eliminaUsuario($nombreUsuario){
        $user = self::buscaUsuario($nombreUsuario); 
        if (!$user) {
            $html="No";
        }
        else{ 
       return self::elimina($user); 
        }
    }

    private static function elimina($usuario) 
    {
        $eliminado = false;
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $id = $usuario->id; 
        $query=sprintf("DELETE FROM usuarios WHERE id ='$id'",$conn->real_escape_string($id));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido borrar el usuario: " . $usuario->nombreUsuario;
                exit();
            }
            elseif ($conn->affected_rows ==1){
                echo "Usuario . $usuario->nombreUsuario . borrado";
                $eliminado =true;
            }
        } else {
            echo "Error al borrar de la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $eliminado;
    }

    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public static function guarda($usuario)
    {
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }
    
    private static function inserta($usuario)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO `usuarios` (`dni`, `nombre`, `nombreUsuario`, `password`, `direccion`, `email`, `telefono`, `ciudad`, `codigo postal`, `carrito`, `tarjeta credito`) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d')"
            , $conn->real_escape_string($usuario->dni)    
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->direccion)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->telefono)
            , $conn->real_escape_string($usuario->ciudad)
            , $conn->real_escape_string($usuario->codigoPostal)
            , $conn->real_escape_string($usuario->carrito)
            , $conn->real_escape_string($usuario->tarjetaCredito));

        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
    
    private static function actualiza($usuario)
    {
        $app = App::getSingleton();
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
    }

    
    private $id;

    private $password;

    private $dni;

    private $direccion;

    private $email;

    private $telefono;

    private $ciudad;

    private $codigoPostal;

    private $carrito;

    private $tarjetaCredito;

    private $nombreUsuario;

    private $roles;


    private function __construct($nombre, $nombreUsuario, $password,  $dni, $direccion, $email, $telefono, $ciudad, $codigoPostal, $tarjetaCredito )
    {
        $this->nombre = $nombre;
        $this->nombreUsuario= $nombreUsuario;
        $this->password = $password;
        $this->dni = $dni;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->ciudad = $ciudad;
        $this->codigoPostal = $codigoPostal;
        $this->carrito = 0; //new carrito
        $this->tarjetaCredito = $tarjetaCredito;
        $this->roles = [];
    }

    public function id()
    {
        return $this->id;
    }

    public function password()
    {
        return $this->password;
    }

    public function addRol($role)
    {
    $this->roles[] = $role;
     }

    public function roles()
     {
      return $this->roles;
    }

    public function nombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function dni()
    {
        return $this->dnis;
    }

    public function direccion()
    {
        return $this->direccion;
    }

    public function email()
    {
        return $this->email;
    }

    public function telefono()
    {
        return $this->telefono;
    }

    public function ciudad()
    {
        return $this->ciudad;
    }

    public function codigoPostal()
    {
        return $this->codigoPostal;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    public function carrito()
    {
        return $this->carrito;
    }

    public function compruebaPassword($password)
    {
       /* echo $password;
        echo "<br>";
        
        echo $this->password;
        echo "<br>";*/

        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
}
