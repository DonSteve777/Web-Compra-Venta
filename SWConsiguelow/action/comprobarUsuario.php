<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Usuario as Usuario;

	if (isset($_GET['user']) && !empty($_GET['user'])){
		$usuario = $_GET['user'];
		$todos = array();
		$todos = Usuario::getAll();
		$disponible = true;
		$i=0;
		$arrayLenght = count($todos);

		while ($i < $arrayLenght && $disponible){
			if ($usuario==$todos[$i]['nombreUsuario']){
				$disponible = false;
			}
			$i++;
		}
        if (!$disponible){
			echo 'existe';
		}
		else{
			echo 'disponible';
		}
		
	}

?>