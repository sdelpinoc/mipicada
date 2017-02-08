<?php
namespace configuracion;

class Peticion {

    private $controlador = '';
    private $metodo = '';
    private $argumento = [];

    public function __construct()
    {
        if (isset($_GET['url'])) {

            // print_r($_GET['url']);

            $ruta = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $ruta = explode("/", $ruta);
            $ruta = array_filter($ruta);

            // var_dump($ruta);
            // print '<pre>';print_r($ruta);print '</pre>';

            $this->controlador = strtolower(array_shift($ruta));

            if (!empty($ruta)) {
                $this->metodo = strtolower(array_shift($ruta));
            } else {
                $this->metodo = 'index';
            }

            if (!empty($ruta)) {
                $this->argumento = $ruta;
            }

            print '<pre>';var_dump(get_object_vars($this));print '</pre>';
        } else {
            $this->controlador = 'picada';
            $this->metodo = 'index';
        }
    }

    public function getControlador()
    {
        return $this->controlador;
    }

    public function getMetodo()
    {
        return $this->metodo;
    }

    public function getArgumento()
    {
        return $this->argumento;
    }

}
