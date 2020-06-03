<?php
namespace es\fdi\ucm\aw;


class FormularioFiltrar extends Form
{
    public function __construct() {
        parent::__construct('formFiltrar');
    }
    
   /* protected function generaCamposFormulario($datos)
    {
        $nombreProd = '';
        $nombreCat='';
        if ($datos) {
            $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : $nombreProd;
            $nombreCat = isset($datos['tipo']) ? $datos['tipo'] : $nombreCat;
        }
        $html = <<<EOF
        <fieldset>
            <legend>Buscar un producto</legend></br>
            <form method="post" action="Producto.php">
            <p><label>Filtrar por nombre:</label> <input type="text" name="nombre" value="$nombreProd"/></p>
            <p><label>Filtrar por categoria:</label> <input type="text" name="tipo" value="$nombreCat"/></p>
            <button type="submit" name="search">Buscar</button>
            </form>
        </fieldset>
EOF;
        return $html;
    }*/

    protected function generaCamposFormulario ($datos)
    {
        $nombreProd = '';
        $nombreCat='';
      if ($datos) {
        $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : $nombreProd;
        $nombreCat = isset($datos['tipo']) ? $datos['tipo'] : $nombreCat;
      }
      $camposFormulario=<<<EOF
      <fieldset>
      <legend>Buscar un producto</legend></br>
      <form method="post" action="Producto.php">
      <p><label>Filtrar por nombre:</label> <input type="text" name="nombre" value="$nombreProd"/></p>
      <p><label>Filtrar por categoria:</label> <input type="text" name="tipo" value="$nombreCat"/></p>
      <button type="submit" name="search">Buscar</button>
      </form>
    </fieldset>
EOF;
      return $camposFormulario;
    }
    

   /* protected function procesaFormulario($datos)
    {
        $result = array();
        
        $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : null;
        $nombreCat = isset($datos['tipo']) ? $datos['tipo'] : null;
                
       if ( empty($nombreProd) && empty($nombreCat)) {
            $result[] = "Debes rellenar al menos algun campo para filtrar";
        }
        
        if (count($result) === 0) {
            if(strlen($nombreProd)>0){
            $result=Producto::muestraProductosPorNombre($nombreProd);
            }
            elseif (strlen($nombreCat)>0){
             Producto::muestraProductosPorCat();
            }
    }
        return $result;
    }*/

    protected function procesaFormulario($datos)
  {
    $result = array();
    $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : null;
   // $nombreCat = isset($datos['tipo']) ? $datos['tipo'] : null;
    $nombreCat = $datos['tipo'] ?? '' ;
    if ( empty($nombreProd) && empty($nombreCat)) {
        $result[] = "Debes rellenar al menos algun campo para filtrar";
    }

    if (count($result) === 0) {
      $prod = Producto::muestraProductosPorNombre($nombreProd);
      if ( $prod ) {
        $result = $prod;
        //$result = Aplicacion::getSingleton()->resuelve('/index.php');
      }else {
        $result[] = 'El usuario o la contraseña es incorrecta';
      }
    }
    return $result;
  }

}