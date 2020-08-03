<?php
require_once __DIR__.'/includes/config.php'; 
use es\fdi\ucm\aw\Aplicacion as App;

$form = new FormularioLogin(); 
$htmlForm = $form->gestiona();

App::getSingleton()->logout();
if (App::getSingleton()->usuarioLogueado())
    echo 'logueado';
else {
    echo $htmlForm;
}