<?php
namespace es\fdi\ucm\aw;
use es\fdi\ucm\aw\Categoria;
//require_once __DIR__.'/Form.php';
//require_once __DIR__.'/Usuario.php';*/

class FormularioCategoria extends Form
{
    public function __construct() {
        parent::__construct('formAltaCat');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $nombreCat ='';
        $descrCat='';

        if ($datos) {
            $nombreCat = isset($datos['nombreCat']) ? $datos['nombreCat'] : $nombreCat;
            $descrCat = isset($datos['descrCat']) ? $datos['descrCat'] : $descrCat;
        }
        $html = <<<EOF
        <div class="form-group m-2" >
            <fieldset>
                <div class="form-group">
                    <label>Nombre de categoria:</label> <input class="form-control" type="text" name="nombreCat" value="$nombreCat" />
                </div>
                <div class="form-group">
                    <label>Descripcion:</label> <input class="form-control" type="text" name="descrCat" value="$descrCat" />
                </div>
                <div class="form-group text-center"><button class=" btn btn-info" type="submit" name="registro">Dar de alta</button></div>
            </fieldset>
        </div>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        $patron_2 = "/^[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    
        $nombreCat = isset($datos['nombreCat']) ? $datos['nombreCat'] : null;
        
        if ( empty($nombreCat) || mb_strlen($nombreCat) < 3 || mb_strlen($nombreCat) > 15) {
            $result[] = "Longitud minima de categoria es 3 y máximo 10 caracteres.";
        }
        if(!preg_match($patron_texto, $nombreCat)){
            $result[] = "Formato del nombre de categoria no valido. (No puede contener numeros)";
        }

        $descrCat = isset($datos['descrCat']) ? $datos['descrCat'] : null;

        if ( empty($descrCat) || mb_strlen($descrCat) < 2 || mb_strlen($descrCat) > 150) {
            $result[] = "La descripcion tiene que tener entre 2 y 150 caracteres.";
        }

        if(!preg_match($patron_2, $descrCat)){
            $result[] = "Formato descripcion no valido.";
        }
        
        if (count($result) === 0) {
            $cat = Categoria::crea($nombreCat, $descrCat);
            $result = $cat;
            if ( ! $cat ) {
                $result[] = "La categoria que intentas añadir ya existe";
            } else {
                echo "Categoria añadida con exito";
            }
        }
        return $result;
    }
}