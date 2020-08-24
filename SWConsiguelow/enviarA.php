<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\FormEnviarA;

$form = new FormEnviarA(); 
$result = $form->gestiona();
echo $result;
?>