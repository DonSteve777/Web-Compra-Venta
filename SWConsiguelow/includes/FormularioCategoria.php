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
		<fieldset>
			<div class="grupo-control">
				<label>Nombre de categoria:</label> <input class="control" type="text" name="nombreCat" value="$nombreCat" />
			</div>
			<div class="grupo-control">
				<label>Descripcion:</label> <input class="control" type="text" name="descrCat" value="$descrCat" />
			</div>
            <div class="grupo-control"><button type="submit" name="registro">Dar de alta</button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
    
        $nombreCat = isset($datos['nombreCat']) ? $datos['nombreCat'] : null;

        if ( empty($nombreCat) ) {
            $result[] = "La categoria no puede estar vacía.";
        }

        $descrCat = isset($datos['descrCat']) ? $datos['descrCat'] : null;

        if ( empty($descrCat) ) {
            $result[] = "La descr no puede estar vacía.";
        }
        
        if (count($result) === 0) {
            $cat = Categoria::crea($nombreCat, $descrCat);
            $result = $cat;
            if ( ! $cat ) {
                $result[] = "La categoria que intentas añadir ya existe";
            } else {
                echo '<script type="text/javascript">
                    alert("Categoria añadida con exito");
                    window.location.assign("index.php");
                    </script>';
            }
        }
        return $result;
    }
}