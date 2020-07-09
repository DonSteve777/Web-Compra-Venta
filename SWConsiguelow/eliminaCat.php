<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        
        $nombreCat = $_GET['categoria'];
        if(Categoria::eliminaCat($nombreCat)){
            echo '<script type="text/javascript">
        alert("Categoria eliminada con exito");
        window.location.assign("index.php");
        </script>';
        }
    }
    else{
        '<script type="text/javascript">
        alert("No eres admin");
        window.location.assign("login.php");
        </script>';
    }