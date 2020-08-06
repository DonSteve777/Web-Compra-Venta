<?php
require_once __DIR__.'/includes/config.php'; 
use es\fdi\ucm\aw\Aplicacion as App;
use es\fdi\ucm\aw\FormularioLogin;



if (App::getSingleton()->usuarioLogueado())
    echo 'logueado';
else {
    //podría intentear afinar generando este html solo en caso de usarlo, como respuesta a una petición
    $form = new FormularioLogin(); 
    $htmlForm = $form->gestiona();
    $htmlForm.=<<<EOF
                <h6 class="mt-4"><a href="registro.php">¿Todavía no tienes cuenta? Regístrate aquí</a></h6>
EOF;
    echo $htmlForm;
}