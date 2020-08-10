<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        if(isset($_POST['categoria'])){
        $idCat = isset($_POST['categoria']) ? $_POST['categoria'] : null;
        if(Categoria::eliminaCat($idCat)){
            echo '<script type="text/javascript">
        alert("Categoria eliminada con exito");
        window.location.assign("index.php");
        </script>';
        }
     } 
    }
    else{
        '<script type="text/javascript">
        alert("No eres admin");
        window.location.assign("login.php");
        </script>';
    }