<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $idUsuario = isset($_POST['deleteUsr']) ? $_POST['deleteUsr'] : null;
        if(isset($idUsuario)){
            $eliminado = Usuario::eliminaUsuario($idUsuario);
            if($eliminado){
                echo '<script type="text/javascript">
            alert("Usuario eliminado con exito");
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