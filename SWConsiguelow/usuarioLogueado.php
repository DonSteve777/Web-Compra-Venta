<?php
require_once __DIR__.'/includes/config.php'; 
use es\fdi\ucm\aw\Aplicacion as App;

header('Content-Type: application/text; charset=utf-8');

if (App::getSingleton()->usuarioLogueado())
    echo 'logueado';
else {
    echo 'no';
}