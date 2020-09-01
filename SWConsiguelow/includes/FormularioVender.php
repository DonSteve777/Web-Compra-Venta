<?php
namespace es\fdi\ucm\aw;
use es\fdi\ucm\aw\ImageUpload;
use es\fdi\ucm\aw\Talla;
use es\fdi\ucm\aw\Aplicacion;

class FormularioVender extends Form
{
    public function __construct() {
        $opciones['enctype'] = 'multipart/form-data';
        parent::__construct('formVender', $opciones );
    }
    
    protected function generaCamposFormulario($datos)
    {
       $nombreProd = '';
        $descripcion= '';
        $precio ='';
        $talla= new Talla();
        $categoria ='';
        $unidades='';
        $imgUpload='';

        if ($datos) {
            $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : $nombreProd;
            $descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : $descripcion;
            $precio = isset($datos['precio']) ? $datos['precio'] : $precio;
            $unidades = isset($datos['unidades']) ? $datos['unidades'] : $unidades;
            if (isset($datos['talla'])){
                $talla->setTalla($datos['talla']);
            }
//            $talla = isset($datos['talla']) ? $talla->setTalla($datos['talla']) : $talla;
            $categoria = isset($datos['categoria']) ? $datos['categoria'] : $categoria;
            $imgUpload = isset($datos['imagen']) ? $datos['imagen'] : $imgUpload;
        }
        $cat = Categoria::getAll();
       
        $selectCategory='';
        $selectCategory =<<<EOF
        <select class="category" name="categoria">
        <option selected="selected">elige categoría</option>
EOF;
        foreach($cat as $item){
            $nombre = $item->nombre();
            $id = $item->id();
        $selectCategory .= <<<EOF
            <option value="$id"> $nombre</option>
EOF;
        }
        $selectTalla='';
        for ($x = 0; $x < $talla->numValores(); $x++) {
            $texto = $talla->getValor($x);
           
            $selectTalla.=<<<EOF
                        <option value="$x">$texto</option>
EOF;
} 
       $html =<<<EOF
       <div class="form-group m-2" >
            <fieldset>
            <p><label>Nombre del producto:</label> 
            <input class="form-control" type="text" name="nombre" value="$nombreProd"/></p>
            <p><label>Descripcion</label> 
            <input type="text" class="form-control" name="descripcion" value="$descripcion"/></p>
            <p><label>Precio del producto:</label> 
            <input type="text" class="form-control" name="precio" value="$precio"/></p>
            <p><label>Unidades:</label> 
            <input type="text" class="form-control" name="unidades" value="$unidades"/></p>
            <p><label>Talla</label> 
            <select name="talla">
                $selectTalla    
            </select>
            <p><label>Categoria</label> 
                $selectCategory
            </select>
            <p><label>Imagen</label> 
            <input type="file" class="form-control" name="imagen" value="$imgUpload"/></p>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-info" name="sell">Vender</button>
            </div>
            </fieldset>
        </div>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
       $result = array();
        $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : null;
        if (empty($nombreProd)) {
            $result[] = "El nombre del producto no puede estar vacío";
        }
        
        $descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : null;
        if ( empty($descripcion) ) {
            $result[] = "La descripcion no puede estar vacía.";
        }

        $precio = isset($datos['precio']) ? $datos['precio'] : null;
        if ( empty($precio) ) {
            $result[] = "El precio no puede ser nulo.";
        }

        $unidades = isset($datos['unidades']) ? $datos['unidades'] : null;      
        if ( empty($unidades) ) {
            $result[] = "El numero de unidades no puede ser nulo";
        }

        $talla = isset($datos['talla']) ? $datos['talla'] : null;
        if ( empty($talla) ) {
            $result[] = "La talla no puede estar vacía  .";
        }
        
        $categoria = isset($datos['categoria']) ? $datos['categoria'] : null;
        $categoria = intval($categoria);
        if ( empty($categoria) ) {
            $result[] = "La categoria no puede estar vacía.";
        }
      if (count($result) === 0) {
            $app = Aplicacion::getSingleton();
            $idvendedor = $app->userid();
            $tallaObj = new Talla($talla);
            $producto = Producto::añadeProd($nombreProd, $idvendedor, $descripcion, $precio,$unidades,$tallaObj->getTalla(),$categoria);
            if ($producto){
                $imgupload = new ImageUpload($_FILES, $producto->id());
                if (! $imgupload->uploadImages()){
                    $result[] = "No se ha podido subir la imagen del producto";
                }else{
                    $result = 'index.php';
                }
            }       
            // No se da pistas a un posible atacante      
            else{
                $result[] = "No se ha podido añadir el producto";
            }
       }
        return $result;
    }
}
