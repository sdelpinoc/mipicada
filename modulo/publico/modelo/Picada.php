<?php
namespace modelo;

class Picada {

    private $_id = 0;
    private $_nombre = '';

    private $_aObjPicadas = [];

    public function __construct()
    {
        $this->conexion = new \Conexion();
    }

    public function getAObjPicadas()
    {
        return $this->_aObjPicadas;
    }

    public function obtieneListado()
    {
        $sql = '
            SELECT
                *
            FROM
                picada
            ORDER BY
                id ASC
        ;';

        $aResultado = $this->conexion->consulta($sql, array());

        // print '<pre>';print_r($aResultado);print '</pre>';

        return $aResultado;
    }
}
