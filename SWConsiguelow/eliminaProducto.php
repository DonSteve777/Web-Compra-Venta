<?php namespace es\fdi\ucm\aw;
require_once __DIR__.'/includes/config.php';


    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $idProd = $_POST['delete'];
        if(isset($idProd)){
        Producto::eliminaById($idProd);
        if(Producto::eliminaById($idProd)){
            echo '<script type="text/javascript">
        alert("Prod eliminado con exito");
        window.location.assign("index.php");
        </script>';
        }
      }
    }
    else{
        echo '<script type="text/javascript">
        alert("No has hecho login, se te mandará a login");
        window.location.assign("login.php");
        </script>';
    }
    