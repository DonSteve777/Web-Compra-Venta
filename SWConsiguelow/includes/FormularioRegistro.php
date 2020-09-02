<?php
namespace es\fdi\ucm\aw;

class FormularioRegistro extends Form
{
    const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';
 
    public function __construct() {
        parent::__construct('formRegistro');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $nombreUsuario = 'UsernameSample2020';
        $nombre = '';
        $dni = '';
        $direccion = '';
        $email = '';
        $telefono = '';
        $ciudad = '';
        $codigoPostal = ''; 
        $tarjetaCredito = '';
        

        if ($datos) {
            $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : $nombreUsuario;
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
        }
        $html = <<<EOF
        <div class="form-group m-2" >
            <fieldset>
                <div class="form-group m-2">
                    <label>Nombre de usuario:</label> 
                    <div class="input-group">
                            <input autocomplete="on" required id="campoUser" class="form-control" type="text" name="nombreUsuario" value="$nombreUsuario" />
                            <div class="input-group-append"> 
                                <button type="button" id="checkButton" class="btn btn-info ml-2">Check</button>
                                <span id="userOK" class="text-danger ml-2"></span>
                            </div>
                    </div>
                    <span id="regexpr" class="text-danger">El nombre de usuario sólo puede contener símbolos alfanuméricos</span>
                </div>
                <div class="form-group m-2">
                    <label>Nombre completo:</label> <input required class="form-control" type="text" name="nombre" value="$nombre" />
                </div>
                <div class="form-group m-2">
                    <label>Password:</label> <input required class="form-control" type="password" name="password" autocomplete="off"/>
                </div>
                <div class="form-group m-2"><label>Vuelve a introducir el Password:</label> <input required class="form-control" type="password" name="password2" autocomplete="off" /><br /></div>
                
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
                <div class="form-group text-center"><button class=" btn btn-info" type="submit" name="registro">Registrar</button></div>
            </fieldset>
        </div>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : null;
        
        if ( empty($nombreUsuario) || mb_strlen($nombreUsuario) < 5 || mb_strlen($nombreUsuario) > 15 ) {
            $result[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres, y no más de 15";
        }
        
        $nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
        if ( empty($nombre) || mb_strlen($nombre) < 5 || mb_strlen($nombre) > 30 ) {
            $result[] = "El nombre tiene que tener una longitud de al menos 5 caracteres, y no más de 30";
        }

        $password = isset($datos['password']) ? $datos['password'] : null;
        if ( empty($password) || mb_strlen($password) < 5 || mb_strlen($password) > 80 ) {
            $result[] = "El password tiene que tener una longitud de al menos 5 caracteres y no más de 80";
        }

        $password2 = isset($datos['password2']) ? $datos['password2'] : null;

        if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
            $result[] = "Los passwords deben coincidir";
        }
        $dni = isset($datos['dni']) ? $datos['dni'] : null;
        if ( empty($dni)) {
            $result[] = "El campo dni es obligatorio";
        }
        if (strlen($dni) != 9 || !preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $dni)){
            $result[] = "Formato del dni incorrecto. Ejemplo 12345678Z";
        }

        $direccion = isset($datos['direccion']) ? $datos['direccion'] : null;
        if ( empty($direccion)) {
            $result[] = "El campo direccion es obligatorio";
        }

        if ( mb_strlen($direccion) > 100 ) {
            $result[] = "El campo direccion es demasiado largo (100 máximo)";
        }

        $email = isset($datos['email']) ? $datos['email'] : null;
        if ( empty($email) ) {
            $result[] = "El campo email es obligatorio";
        }
        if (!mb_ereg_match(self::HTML5_EMAIL_REGEXP, $email) ) {
            $result[] = "El campo email no es válido";
        }
        $telefono = isset($datos['telefono']) ? $datos['telefono'] : null;
        if ( empty($telefono) ) {
            $result[] = "El campo telefono es obligatorio";
        }

        if ( !preg_match('/^6[0-9]{8}$/', $telefono) 
        && !preg_match('/^[9|8|6|7][0-9]{8}$/', $telefono) ) {
            $result[] = "El campo telefono no es válido";
        }

        $ciudad = isset($datos['ciudad']) ? $datos['ciudad'] : null;
        if ( empty($ciudad) ) {
            $result[] = "El campo ciudad es obligatorio";
        }

        if ( mb_strlen($direccion) > 12 ) {
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
        if ( empty($tarjetaCredito) ) {
            $result[] = "El campo tarjeta de Crédito es obligatorio";
        }
        //^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35d{3})d{11})$

        
        if (count($result) === 0) {
            $user = Usuario::crea($nombre, $nombreUsuario, $password,  $dni, $direccion, $email, $telefono, $ciudad, $codigoPostal, $tarjetaCredito);
            if ( ! $user ) {
                $result[] = "El usuario ya existe";
            } else {
                Aplicacion::getSingleton()->login($user);
                $result = 'index.php';
                //$result = Aplicacion::getSingleton()->resuelve('/index.php');
            }
        }
        return $result;
    }
}