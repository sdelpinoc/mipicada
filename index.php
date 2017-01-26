<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(dirname(__DIR__));

ini_set('memory_limit', '1500M');
date_default_timezone_set(@date_default_timezone_get());

define('DIRECTORIO_RAIZ', dirname(__FILE__));
define('SALTO_LINEA',  "\r\n");
define('SEPARADOR_DIRECTORIO', DIRECTORY_SEPARATOR);

require_once __DIR__ . '/modulo/clases/configuracionBD.php';
require_once __DIR__ . '/modulo/clases/configuracion.php';

// require_once __DIR__ . '/modulo/clases/Ayuda.php';
// require_once __DIR__ . '/modulo/clases/Conexion.php';


require_once 'base.html';

?>
