<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';

    if ($app->tieneRol('admin', 'Acceso Denegado', 'No tienes permisos suficientes para administrar la web.')) {
        if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $idCat = isset($_POST['delete']) ? $_POST['delete'] : null;
        if(isset($idCat)){
        Categoria::eliminaCat($idCat);
            if(Categoria::eliminaCat($idCat)){
            echo "";
             }
        }
      }
    }
