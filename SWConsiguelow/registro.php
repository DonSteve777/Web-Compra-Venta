<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioRegistro.php';
use es\fdi\ucm\aw\FormularioRegistro;
$form = new FormularioRegistro(); 
$html = $form->gestiona();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Registro</title>
</head>

<body>

<div id="contenedor">

<?php
	require("includes/common/cabecera.php");
?>

	<div id="contenido">
		<h1>Registro de usuario</h1>
<?php 
    echo $html;
?>
	</div>


</div>

</body>
</html>