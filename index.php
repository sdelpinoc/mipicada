<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(dirname(__DIR__));

ini_set('memory_limit', '1500M');
date_default_timezone_set(@date_default_timezone_get());

function autoCarga($claseNombre)
{
    $aRutasArchivos = array(
        '', // -- Inlcuir rutas de las clases
    );

    foreach ($aRutasArchivos as $rutaArchivo) :

        $claseNombre = str_replace('\\', DIRECTORY_SEPARATOR, $claseNombre);

        if (file_exists($rutaArchivo . $claseNombre . '.php')) {
            require_once $rutaArchivo . $claseNombre . '.php';
        }

    endforeach ;
}

spl_autoload_register('autoCarga');

function iniciaSesion()
{
    if (version_compare(phpversion(), '5.4.0', '>=')) {
        session_status() === PHP_SESSION_ACTIVE ? '' : session_start() ;
    } else {
        session_id() === '' ? session_start() : '' ;
    }
}

print '__DIR__: ' . __DIR__;
print '<hr />';
print '$_GET: ';
print '<pre>';print_r($_GET);print '</pre>';
print '<hr />';
?>