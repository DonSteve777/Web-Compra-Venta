<?php
require_once __DIR__.'/includes/config.php'; 
use es\fdi\ucm\aw\Aplicacion as App;

if (App::getSingleton()->usuarioLogueado())
    echo 'logueado';
else {
    echo 'no';
}