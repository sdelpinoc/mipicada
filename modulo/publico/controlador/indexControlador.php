<?php
namespace publico;

use Modelo\Picada as Picada;

class indexControlador {

    private $objPicada;

    public function __construct()
    {
        $this->objPicada = new Picada();
    }

    public function index()
    {
        return $this->objPicada->obtieneListado();
    }

    public function error()
    {
        return array();
    }
}
