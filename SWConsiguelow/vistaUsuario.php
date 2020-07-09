<?php 
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Usuario;

function muestraInfoUsuario(){
$usuario = $_SESSION['nombre'];
$user = Usuario::muestraInfo($usuario);
$html = '';
$html.=<<<EOF
  <ul class="list-group">
EOF;
    foreach($user as $key => $fila){         
      $nombreUsuario =  $fila['usuario'];
      $nombre =  $fila['nombre'];
      $direccion =  $fila['direccion'];
      $ciudad= $fila['ciudad'];
      $cp = $fila['cp'];
      $email = $fila['email'];

          $html.=<<<EOF
          <li class="list-group-item">
            <div class="d-flex flex-column">
                  <div class="p-2 m-3 flex-fill">
                  <p>Usuario: $nombreUsuario</p>
                  </div>
                  <div class="p-2 m-3 flex-fill">
                  <p>Nombre completo: $nombre</p>
                  </div>
                  <div class="p-2 m-3 flex-fill">
                  <p>Direccion: $direccion</p>
                  </div>
                  <div class="p-2 m-3 flex-fill">
                      <p>Ciudad: $ciudad</p>
                  </div>
                  <div class="p-2 m-3 flex-fill">
                      <p>Codigo postal: $cp</p>
                  </div>
                  <div class="p-2 m-3 flex-fill">
                      <p>Email: $email</p>
                  </div>
                  <div class="mb-2">
                    <a class="text-center btn btn-info" href="vistaPedidos.php?">
                      Pedidos del usuario</a>
                    <a class="text-center btn btn-info" href="vistaProdsUsuario.php?">
                      Productos del usuario</a>
                  </div>
            </div>
          </li>     
EOF;
    }
  $html.=<<<EOF
  </ul>
EOF;
  return $html;
}
?>

<html>
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
        <div class="row align-items-start">
        </div>
        <div class="row align-items-center">
            <div class="col-4">
            </div>
            <div class="col-4">
                <div class="m-3">
                <h1 class="text-center">Info usuario</h1>
            <?php
                echo muestraInfoUsuario();
            ?>
                </div>
            </div>
            <div class="col-4">
            </div>
        </div>
        <div class="row align-items-end">
        </div>    
    </body>
</html>