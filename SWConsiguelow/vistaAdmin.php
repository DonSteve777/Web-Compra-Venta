<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Admin</title>
    </head>
<body>
<div id="contenedor">
<?php
$app->doInclude('common/cabecera.php');
?>
	<div id="contenido">
<?php

if ($app->tieneRol('admin', 'Acceso Denegado', 'No tienes permisos suficientes para administrar la web.')) {

?>
		<h1>Consola de administración</h1></br>
        <a href='anadeCategoria.php'>Añadir una categoria</a></br>
        <a href='listaCategorias.php'>Ver categorias ya existentes</a></br>
        <a href='eliminaProducto.php'>Eliminar un producto</a></br>
        <a href='vistaUsuarios.php'>Ver todos los usuarios de la web</a></br>


<?php
}
?>
	</div>

</div>
</body>
</html>