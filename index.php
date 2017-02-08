<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(dirname(__DIR__));

ini_set('memory_limit', '1500M');
date_default_timezone_set(@date_default_timezone_get());

define('SL',  "\r\n"); // SALTO_LINEA
define('DS', DIRECTORY_SEPARATOR); // DIRECTORIO_SEPARADOR
define('DR', dirname(__FILE__) . DS); // DIRECTORIO_RAIZ
define('URL', 'http://localhost/mipicada/');
$proc = TRUE;

print 'Directorio Raíz(DR): ' . DR;
print '<hr />';

require_once DR . 'modulo/clases/configuracionBD.php';
require_once DR . 'modulo/configuracion/AutoCarga.php';

configuracion\AutoCarga::iniciar();

require_once DR . 'modulo/publico/vista/Plantilla.php';

$aDatos = configuracion\Enrutador::iniciar(new configuracion\Peticion());

?>
