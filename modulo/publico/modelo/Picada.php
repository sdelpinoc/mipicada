<?php
class Picada {

    private $_id = 0;
    private $_nombre = '';

    private $_aObjPicadas = [];

    public function getAObjPicadas()
    {
        return $this->_aObjPicadas;
    }

    public function obtener()
    {
        $sql = 'SELECT VERSION();';

        $prepare = pg_prepare($objConexion->getConexion(), '', $sql);

        if ($prepare) {

            $aParametrosExecute = array();

            $execute = pg_execute($objConexion->getConexion(), '', $aParametrosExecute);

            if ($execute) {
                if (is_resource($execute)) {

                    if (pg_num_rows($execute) > 0) {

                        while ($reg = pg_fetch_assoc($execute)) :

                            print '<pre>';
                            print_r($reg);
                            print '</pre>';
                            print '<br />';

                        endwhile ;

                    } else {
                        print 'No hay registros para listar';
                    }
                }
            } else {
                $objConexion->escribeLog('', $sql);
            }
        } else {
            $objConexion->escribeLog('', $sql);
        }
    }
}
