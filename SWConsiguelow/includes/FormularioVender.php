<?php
namespace es\fdi\ucm\aw;
use es\fdi\ucm\aw\ImageUpload;


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
        $talla='';
        $color='';
        $categoria ='';
        $unidades='';
        $imgUpload='';

        if ($datos) {
            $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : $nombreProd;
            $descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : $descripcion;
            $precio = isset($datos['precio']) ? $datos['precio'] : $precio;
            $unidades = isset($datos['unidades']) ? $datos['unidades'] : $unidades;
            $talla = isset($datos['talla']) ? $datos['talla'] : $talla;
            $color = isset($datos['color']) ? $datos['color'] : $color;
            $categoria = isset($datos['categoria']) ? $datos['categoria'] : $categoria;
            $imgUpload = isset($datos['imagen']) ? $datos['imagen'] : $imgUpload;
        }
        $cat = Categoria::findAll();
        $select =<<<EOF
        <select class="category" name="categoria">
        <option selected="selected">elige categoría</option>
EOF;
        foreach($cat as $item){
            $nombre = $item['nombre'];
            $id = $item['id'];
        $select .= <<<EOF
            <option value="$id"> $nombre</option>
EOF;
        }
 
       $html =<<<EOF
            <fieldset>
            <link rel="stylesheet" href="styles/style.css">
            <legend>Producto, descripcion y precio</legend>
            <p><label>Nombre del producto:</label> 
            <input type="text" name="nombre" value="$nombreProd"/></p>
            <p><label>Descripcion</label> 
            <input type="text" name="descripcion" value="$descripcion"/></p>
            <p><label>Precio del producto:</label> 
            <input type="text" name="precio" value="$precio"/></p>
            <p><label>Unidades:</label> 
            <input type="text" name="unidades" value="$unidades"/></p>
            <p><label>Talla</label> 
            <select name="talla">
                <option value="--">Not sizeable</option>
                <option value="xs">xs</option>
                <option value="s">s</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
            <p><label>Color del producto:</label> 
            <input type="text" name="color" value="$color"/></p>
            <p><label>Categoria</label> 
            $select;
            </select>
            <p><label>Imagen</label> 
            <input type="file" name="imagen" value="$imgUpload"/></p>
            <button type="submit" name="sell">Vender</button>
            </fieldset>
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
            $result[] = "La talla no puede estar vacía.";
        }
        
        $color = isset($datos['color']) ? $datos['color'] : null;

        if ( empty($color) ) {
            $result[] = "El color no puede estar vacía.";
        }
                
        $categoria = isset($datos['categoria']) ? $datos['categoria'] : null;
        $categoria = intval($categoria);

        if ( empty($categoria) ) {
            $result[] = "La categoria no puede estar vacía.";
        }

       if (count($result) === 0) {
            $idvendedor = $_SESSION['userid'];
            $producto = Producto::añadeProd($nombreProd, $idvendedor, $descripcion, $precio,$unidades,$talla,$color,$categoria);
            $imgupload = new ImageUpload($_FILES, $producto->id());
            $result = $imgupload->uploadImages();
            if ( ! $producto ) {
                // No se da pistas a un posible atacante
                $result[] = "No se ha podido añadir el producto";
            }else{
                $result = 'index.php';
                        }
        }
        return $result;
    }

}
