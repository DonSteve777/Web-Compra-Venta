<?php
namespace es\fdi\ucm\aw;
//require_once __DIR__.'/Form.php';
//require_once __DIR__.'/Usuario.php';
use es\fdi\ucm\aw\Usuario;
use es\fdi\ucm\aw\Aplicacion as App;

class FormEnviarA extends Form
{
    const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct()
  {
   //$opciones['class'] =  'form-signin';
   $opciones = array();
   $opciones['ajax'] = 'true';
    parent::__construct('formEnviarA', $opciones);
  }
  
  protected function generaCamposFormulario($datos)
    {
        $app = App::getSingleton();
        $userid = $app->userid();
        $usuario = Usuario::getById($userid);
        $nombre = $usuario->nombre();
        $dni = $usuario->dni();
        $direccion = $usuario->direccion();
        $email = $usuario->email();
        $telefono = $usuario->telefono();
        $ciudad = $usuario->ciudad();
        $codigoPostal = $usuario->codigoPostal(); 
        $tarjetaCredito = $usuario->tarjetaCredito();

        $html = <<<EOF
        <div class="form-group m-2" >
            <fieldset>
                <div class="form-group m-2">
                    <label>Nombre:</label> <input required class="form-control" type="text" name="nombre" value="$nombre" />
                </div>                
                <div class="form-group m-2">
                    <label>dni:</label> <input class="form-control" type="text" name="dni" value="$dni" />
                </div>
                <div class="form-group m-2">
                    <label>direccion:</label> <input class="form-control" type="text" name="direccion" value="$direccion" />
                </div>
                <div class="form-group m-2">
                    <label> email:</label> <input class="form-control" type="text" name="email" value="$email" />
                </div>
                <div class="form-group m-2">
                    <label>telefono:</label> <input class="form-control" type="text" name="telefono" value="$telefono" />
                </div>
                <div class="form-group m-2">
                    <label>ciudad:</label> <input class="form-control" type="text" name="ciudad" value="$ciudad" />
                </div>
                <div class="form-group m-2">
                    <label>codigo postal:</label> <input class="form-control" type="text" name="codigoPostal" value="$codigoPostal" />
                </div>
                <div class="form-group m-2">
                    <label>tarjeta credito:</label> <input class="form-control" name="tarjetaCredito" value="$tarjetaCredito"  type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}"placeholder="xxxx xxxx xxxx xxxx" autocomplete="cc-number" maxlength="19" />
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-info" id="btnEnviarA" type="button">Confirmar</button>
                  <button class="btn btn-danger" id="btnCancelar" type="button">Cancelar</button>

                </div>
            </fieldset>
        </div>
EOF;
        return $html;
    }

    protected function  generaHtmlErrores($datos){
        $html = '';
        if (is_array($datos)){
            foreach($datos as $value){
                $html.=<<<EOF
                <p>$value</p>
EOF;
            }
        }
        return $html;
    }

  /**
   * Procesa los datos del formulario.
   */
  protected function procesaFormulario($datos)
  {
    //var_dump($datos);
    $htmlResult = '';
    $result = array();
    $app = App::getSingleton();
    $userid = $app->userid();

    $nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
    if ( empty($nombre) || mb_strlen($nombre) < 5 || mb_strlen($nombre) > 30 ) {
        $result[] = "El nombre tiene que tener una longitud de al menos 5 caracteres, y no más de 30";
    }
    $dni = isset($datos['dni']) ? $datos['dni'] : null;
    if (empty($dni)) {
        $result[] = "El campo dni no puede estar vacío";
    }
    if (strlen($dni) != 9 || !preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $dni)){
        $result[] = "Formato del dni incorrecto. Ejemplo 12345678Z";
    }
    $direccion = isset($datos['direccion']) ? $datos['direccion'] : null;
    if (empty($direccion)) {
        $result[] = "El campo direccion no puede estar vacía";
    }
    if ( mb_strlen($direccion) > 100 ) {
        $result[] = "El campo direccion es demasiado largo (100 máximo)";
    }
    $email = isset($datos['email']) ? $datos['email'] : null;
    if (empty($email)) {
        $result[] = "El campo email no puede estar vacío";
    }
    if (!mb_ereg_match(self::HTML5_EMAIL_REGEXP, $email) ) {
        $result[] = "El campo email no es válido";
    }
    $telefono = isset($datos['telefono']) ? $datos['telefono'] : null;
    if (empty($telefono)) {
        $result[] = "El campo telefono no puede estar vacío";
    }
    if ( !preg_match('/^6[0-9]{8}$/', $telefono) 
        && !preg_match('/^[9|8|6|7][0-9]{8}$/', $telefono) ) {
            $result[] = "El campo telefono no es válido";
        }
        $ciudad = isset($datos['ciudad']) ? $datos['ciudad'] : null;
        if ( empty($ciudad) ) {
            $result[] = "El campo ciudad es obligatorio";
        }

        if ( mb_strlen($ciudad) > 12 ) {
            $result[] = "El campo ciudad es demasiado largo (12 máx)";
        }
        $codigoPostal = isset($datos['codigoPostal']) ? $datos['codigoPostal'] : null;
        if ( empty($codigoPostal)) {
            $result[] = "El campo codigo Postal es obligatorio";
        }
        if (!preg_match('/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', $codigoPostal) || mb_strlen($codigoPostal) > 5 ) {
            $result[] = "El campo codigo Postal no es válido";
        }

    $tarjetaCredito = isset($datos['tarjetaCredito']) ? $datos['tarjetaCredito'] : null;
    if (empty($tarjetaCredito)) {
        $result[] = "El campo tarjeta Credito no puede estar vacío";
    }

    if (count($result) === 0) {
      $usuario = Usuario::getById($userid);
      $usuario->setTarjetaCredito($tarjetaCredito);
      $usuario->setTelefono($telefono);
      $usuario->setCodigoPostal($codigoPostal);
      $usuario->setDni($dni);
      $usuario->setEmail($email);
      $usuario->setCiudad($ciudad);
      $usuario->setDireccion($direccion);
      $usuario->setNombre($nombre);
//      var_dump($usuario);
      $updatedUser = Usuario::guarda($usuario);
      if ($updatedUser){
        $htmlResult=<<<EOF
        <div class="card-body">
          <h6 class="card-subtitle ">Enviar a</h6>
          <div class="p-3">
              <p> $nombre</p>
              <p> $dni </p>
              <p> $direccion</p>
              <p> $telefono</p>
              <p> $ciudad</p>
              <p> $codigoPostal </p>
              <p> $tarjetaCredito</p>
          </div>
          <button type="button" id="editarBtn" class="btn btn-outline-info border-0">Editar</button>
      </div>
EOF;
        return $htmlResult;
      }       
      // No se da pistas a un posible atacante      
      else{
          $result[] = "No se ha podido actualizar la información del envío";
//                $result = 'index.php';
      }
    }
    return $result;
  }
}