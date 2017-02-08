<?php
namespace publico;

use modelo\Picada as Picada;

class picadaControlador {

    private $objPicada;

    public function __construct()
    {
        $this->objPicada = new Picada();
    }

    public function index()
    {
        return $this->objPicada->obtieneListado();
    }

}