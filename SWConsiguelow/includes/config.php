<?php
namespace es\fdi\ucm\aw;
/**
 * @param string $class The fully-qualified class name.
 * @return void
 */
define('BD_NAME', 'consiguelow');
define('BD_USER', 'consiguelow');
define('BD_PASS', 'consiguelow');
define("R_PATH", __DIR__);
define('RUTA_APP', '');
define('INSTALADA', true );
define("F_SIZE", "4M");
/***********LINUX**************/
define('BD_HOST', 'vm05.db.swarm.test');
define("F_PATH", R_PATH.'/../data/productos/');

/***********WINDOWS**************/
//define('BD_HOST', 'localhost');
//define("F_PATH", R_PATH.'\..\data\productos\\');


spl_autoload_register(function ($class) {
    // project-specific namespace prefix
    $prefix = 'es\\fdi\\ucm\\aw';
    // base directory for the namespace prefix
    $base_dir = __DIR__;
    /*echo "class: ";
    echo $class . "\n";*/
    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
/* */
/* InicializaciÃ³n del objeto aplicacion */
/* */
$app = Aplicacion::getSingleton();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS), RUTA_APP, R_PATH);