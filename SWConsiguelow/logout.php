<?php
require_once __DIR__.'/includes/config.php'; 
use es\fdi\ucm\aw\Aplicacion as App;

App::getSingleton()->logout();

    echo '<script type="text/javascript">
    alert("Se ha cerrado la sesion");
    window.location.assign("index.php");
    </script>';
?>
