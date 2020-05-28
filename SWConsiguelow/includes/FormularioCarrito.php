<?php
namespace es\fdi\ucm\aw;

class FormularioCarrito extends Form
{
    public function __construct() {
        parent::__construct('formCarrito');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $prod=$_GET['nombre'];
        $unidades='';
        if ($datos) {
            $unidades = isset($datos['unidades']) ? $datos['unidades'] : $unidades;
        }
        $html = <<<EOF
        <fieldset>
            <legend>Añadir el producto: "$prod" al carrito</legend></br>
            <form method="post" action="Pedido.php">
            <p><label>Unidades:</label> <input type="text" name="number" value="$unidades"/></p>
            <button type="submit" name="search">Buscar</button>
            </form>
        </fieldset>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $unidades = isset($datos['unidades']) ? $datos['unidades'] : null;
                
       if ( empty($unidades)) {
            $result[] = "Debes rellenar el campo unidades";
        }
        
        if (count($result) === 0) {
            if(strlen($unidades)>0){
             Pedido:: guardaPedido($unidades);
            }
    }
        return $result;
    }
}