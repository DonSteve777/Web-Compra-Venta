<?php
namespace es\fdi\ucm\aw;
use es\fdi\ucm\aw\Producto;


class FormularioActualizar extends Form
{
    public function __construct() {
        $opciones['enctype'] = 'multipart/form-data';
        parent::__construct('formActualizar', $opciones );
    }
    
    protected function generaCamposFormulario($datos)
    {
        $id = $_GET['id'];
        $prod = Producto::getById($id);
        $nombreProd = $prod->nombre();
        $descripcion= '';
        $precio ='';
        $talla='';
        $color='';
        $categoria ='';
        $unidades='';
        $imgUpload='';

        if ($datos) {
            //$nombreProd = isset($datos['nombre']) ? $datos['nombre'] : $nombreProd;
            $descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : $descripcion;
            $precio = isset($datos['precio']) ? $datos['precio'] : $precio;
            $unidades = isset($datos['unidades']) ? $datos['unidades'] : $unidades;
            $talla = isset($datos['talla']) ? $datos['talla'] : $talla;
            $color = isset($datos['color']) ? $datos['color'] : $color;
            $categoria = isset($datos['categoria']) ? $datos['categoria'] : $categoria;
            $imgUpload = isset($datos['imagen']) ? $datos['imagen'] : $imgUpload;
        }
        $cat = Categoria::getAll();
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
       <div class="form-group m-2" >
            <fieldset>
            <p><label>Nombre del producto: $nombreProd</label> 
             <p><label>Descripcion</label> 
            <input type="text" class="form-control" name="descripcion" value="$descripcion"/></p>
            <p><label>Precio del producto:</label> 
            <input type="text" class="form-control" name="precio" value="$precio"/></p>
            <p><label>Unidades:</label> 
            <input type="text" class="form-control" name="unidades" value="$unidades"/></p>
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
            <input type="text" class="form-control" name="color" value="$color"/></p>
            <p><label>Categoria</label> 
            $select;
            </select>
            <p><label>Imagen</label> 
            <input type="file" class="form-control" name="imagen" value="$imgUpload"/></p>
            <div class="form-group text-center">
            <button type="submit" class="btn btn-info" name="update">Actualizar</button>
            </div>

            </fieldset>
        </div>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
       $result = array();
        $id = $_GET['id'];
        $prod = Producto::getById($id);
        $nombreProd = $prod->nombre();
        $idvendedor = $prod->vendedor();
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
            $id= $_GET['id'];
            $producto = Producto::getById($id);
            if ($producto){
                $result = Producto::guardaProd($producto);
                //$imgupload = new ImageUpload($_FILES, $producto->id());
                //$result = $imgupload->uploadImages();
                if($result){
                echo '<script type="text/javascript">
                        alert("Producto actualizado con exito");
                        window.location.assign("index.php");
                        </script>';
                }
            }       
            // No se da pistas a un posible atacante      
            else{
                $result[] = "No se ha podido actualizar el producto";
                $result = 'index.php';
                        }
        }
        return $result;
    }

}
