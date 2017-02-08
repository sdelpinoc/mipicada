<?php
namespace configuracion;

class Enrutador {

    public static function iniciar(Peticion $objPeticion)
    {
        $controlador = $objPeticion->getControlador() . 'Controlador';
        // print 'controlador: ' . $controlador;
        $ruta = DR . 'modulo' . DS . 'publico' . DS . 'controlador' . DS . $controlador . '.php';
        print '<br />';
        print 'ruta: ' . $ruta;
        print '<br />';
        var_dump(file_exists($ruta));
        print '<br />';
        $metodo = $objPeticion->getMetodo();
        $argumento = $objPeticion->getArgumento();

        $aDatos = array();

        if (is_readable($ruta)) {
            require_once $ruta;

            $invocarControlador = 'publico\\' . $controlador;

            $controlador = new $invocarControlador();

            // call_user_func(array(__NAMESPACE__ .'\Foo', 'prueba')); // A partir de PHP 5.3.0

            if (empty($argumento)) {

                if (method_exists($controlador, $metodo)) {
                    $aDatos = call_user_func(array($controlador, $metodo));
                } else {
                    $metodo = 'error';
                }

            } else {
                if (method_exists($controlador, $metodo)) {
                    $aDatos = call_user_func(array($controlador, $metodo), $argumento);
                } else {
                    $metdo = 'error';
                }
            }
        }

        // Vista
        $rutaVista = DR . 'modulo' . DS . 'publico' . DS . 'vista' . DS . $objPeticion->getControlador() . DS . $metodo . '.php';

        print '<br />';
        print 'rutaVista: ' . $rutaVista;

        print '<br />';
        // print 'aDatos: ';
        // print '<pre>';print_r($aDatos);print '</pre>';

        if (is_readable($rutaVista)) {
            require_once $rutaVista;
            // $retorna = file_get_contents($rutaVista);
        } else {
            // $retorna = 'No se encontro la ruta';
            print 'No se encontro la ruta';
        }

        // return $retorna;
    }

}
