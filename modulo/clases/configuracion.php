<?php
function autoCarga($claseNombre)
{
    $aRutasArchivos = array(
        DIRECTORIO_RAIZ . SEPARADOR_DIRECTORIO . 'modulo' . SEPARADOR_DIRECTORIO. 'clases' . SEPARADOR_DIRECTORIO, // -- Incluir rutas de las clases
    );

    foreach ($aRutasArchivos as $rutaArchivo) :

        $claseNombre = str_replace('\\', SEPARADOR_DIRECTORIO, $claseNombre);

        // print 'ruta: ' . $rutaArchivo . $claseNombre . '.php';

        if (file_exists($rutaArchivo . $claseNombre . '.php')) {
            require_once $rutaArchivo . $claseNombre . '.php';
        }

    endforeach ;
}

spl_autoload_register('autoCarga');