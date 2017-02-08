<?php
namespace configuracion;

class AutoCarga {

    public static function iniciar()
    {
        spl_autoload_register(function($claseNombre){
            $aRutasArchivos = array(
                DR . 'modulo' . DS . 'clases' . DS, // -- Incluir rutas de las clases
                DR . 'modulo' . DS . 'publico' . DS,
                DR . 'modulo' . DS,
            );

            foreach ($aRutasArchivos as $rutaArchivo) :

                $claseNombre = str_replace("\\", DS, $claseNombre);

                // print 'ruta: ' . $rutaArchivo . $claseNombre . '.php';
                // print '<br />';

                // var_dump(file_exists($rutaArchivo . $claseNombre . '.php'));

                if (file_exists($rutaArchivo . $claseNombre . '.php')) {
                    // print 'existe: ' . $rutaArchivo . $claseNombre . '.php';
                    // print '<br />';
                    require_once $rutaArchivo . $claseNombre . '.php';
                }

            endforeach ;
        });
    }
}
