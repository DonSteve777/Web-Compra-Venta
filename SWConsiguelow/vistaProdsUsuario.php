<?php
use es\fdi\ucm\aw\Producto;
use es\fdi\ucm\aw\ImageUpload;
use es\fdi\ucm\aw\Categoria;

require_once __DIR__.'/includes/config.php';

function muestraProdsUsuario(){
  $idUsuario = $_SESSION['userid'];
  $result= Producto::muestraProdsUsuario($idUsuario);
  $html='';
  $html.=<<<EOF
  <ul class="list-group">
EOF;
  foreach($result as $key => $fila){
      $id =  $fila['id'];
      $imgSrc = ImageUpload::getSource($id);
      $descripcion = $fila['descripcion'];
      $precio= $fila['precio'];
      $categoria = Categoria::findById($fila['categoria'])->nombre();
      $nombre = $fila['nombre'];
      $html.=<<<EOF
          <li class="list-group-item">
              <div class="d-flex flex-row">
                  <div style="height: 200px;">
                      <img class="h-50"  src=$imgSrc alt="no disponible">    
                  </div>
                  <div class="p-2 m-3 flex-fill">
                      <p>Producto: $nombre</p>
                      <p>Descripción: $descripcion</p>
                      <p>Precio: $precio €</p>
                      <p>Categoria: $categoria</p>
                  </div>
                  <div class="d-flex flex-wrap align-content-center">
                  <a class="text-center btn btn-info" href="eliminaProducto.php?nombreProd=$nombre">
                      Quitar</a>
              </div>
              <div class="d-flex flex-wrap align-content-center">
                  <a class="text-center btn btn-info" href="actualizaProd.php?id=$id">
                      Actualizar</a>
              </div>
          </li>     
EOF;
  }
  $html.=<<<EOF
  </ul>
EOF;
/*
} else {
  $html='';
  $html =  <<<EOF
  <p>Aun no has subido ningun producto, anímate a <a href='vender.php'>subir algo.</p>
EOF;
} */
  return $html;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Local Consiguelow</title>
    <link rel="icon" href="img/money.ico"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

    <body>
    <?php
                require("includes/common/cabecera.php");
            ?>
        <div class="container mt-3">
            <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <h1 class="text-center">Productos subidos por el usuario</h1>
                    <?php
                        echo muestraProdsUsuario();
                    ?>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>  
    </body>
</html>