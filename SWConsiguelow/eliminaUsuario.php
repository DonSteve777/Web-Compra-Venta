<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $nombreUsuario = $_GET['username'];
        if(Usuario::eliminaUsuario($nombreUsuario)){
            echo "Usuario $nombreUsuario eliminado";
        }
    }
    else{
        '<script type="text/javascript">
        alert("No eres admin");
        window.location.assign("login.php");
        </script>';
    }