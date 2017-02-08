<?php
class Conexion extends db_mysqli {

    private $_manejador = false;
    private $_logRuta = DR .'logs' . DS . 'sql';

    public function __construct()
    {
        $this->conectar();
    }

    public function __destruct()
    {
        if (BASE_DE_DATOS == 'MYSQL') {
            $this->_manejador->close();
        } elseif (BASE_DE_DATOS == 'POSTGRES') {
            pg_close($this->_manejador);
        }
    }

    public function getConexion()
    {
        return $this->_manejador;
    }

    private function conectar()
    {
        try {

            switch (BASE_DE_DATOS) {

                case 'MYSQL':
                    $this->_manejador = new db_mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    if ($this->_manejador === false) {
                        throw new Exception('Error en la conexion con la db.<br />connect_errno: ' . $this->_manejador->connect_errno . '<br />connect_error: ' . $this->_manejador->connect_error, 901);
                    }
                    break;

                case 'POSTGRES':
                    $this->_manejador = pg_connect(
                        'host=' . DB_HOST .
                        ' dbname=' . DB_NAME .
                        ' user=' . DB_USER .
                        ' password=' . DB_PASS
                    );

                    if (!$this->_manejador) {
                        throw new Exception('Error en la conexion con la db.', 901);
                    }
                    break;

                default:
                    # code...
                    break;
            }


        } catch (Exception $e) {
            $this->escribeLog($e);
        }
    }

    public function escribeLog($texto = '', $ultimaConsulta = '')
    {
        if (BASE_DE_DATOS == 'MYSQL') {
            $texto .= SL;
            foreach ($this->_manejador->dbErrors as $dbErrors) :
                foreach ($dbErrors as $key => $value) :
                    $texto .= $key . ' => ' . $value . SL;
                endforeach ;
                $texto .= SL;
            endforeach ;

        } elseif (BASE_DE_DATOS == 'POSTGRES') {
            $texto = pg_last_error();
        }

        if (!empty($ultimaConsulta)) {
            $texto .= $ultimaConsulta;
        }

        $reg = date('d-m-Y H:i:s', time()) . ' - ' . SL . $texto . SL;

        $nombre_archivo = ($this->_logRuta . DS . date('Ymd', time()) . '.log');

        $arch = fopen($nombre_archivo, 'a');

        if ($arch) {
            fwrite($arch, $reg);
        }
    }

    public function consulta($consulta = '', $aParametros = array())
    {
        $_retorna = array(
            'registrosTotal' => 0,
            'registros' => array(),
        );

        try {
            switch (BASE_DE_DATOS) {

                case 'MYSQL':
                    // And run a small and simple query

                    print 'consulta: ' . $consulta;

                    $aRes = $this->_manejador->query($consulta);
                    // print '<pre>';
                    // print_r($this->_manejador);
                    // var_dump($aRes);
                    // exit();

                    $_retorna['registrosTotal'] = $this->_manejador->num_rows;

                    if ($_retorna['registrosTotal'] > 0) {
                        foreach ($aRes as $reg) {
                            $_retorna['registros'][] = $reg;
                        }
                    } else if (!empty($this->_manejador->dbErrors)) {
                        print_r($this->_manejador->dbErrors);
                        throw new Exception('No se pudo ejecutar su consulta', 904);
                    }

                    break;

                case 'POSTGRES':
                    $prepare = pg_prepare($this->getConexion(), '', $consulta);

                    if ($prepare) {

                        $aParametrosExecute = array();

                        $execute = pg_execute($this->getConexion(), '', $aParametrosExecute);

                        if ($execute) {
                            if (is_resource($execute)) {

                                $_retorna['registrosTotal'] = pg_num_rows($execute);

                                if ($_retorna['registrosTotal'] > 0) {

                                    while ($reg = pg_fetch_assoc($execute)) :

                                        $_retorna['registros'][] = $reg;

                                    endwhile ;

                                }
                            }
                        } else {
                            throw new Exception('No se pudo ejecutar su consulta', 903);
                        }
                    } else {
                        throw new Exception('No se pudo preparar su consulta', 902);
                    }
                    break;

                default:
                    # code...
                    break;
            }

        } catch (Exception $e) {
            $this->escribeLog($e->getMessage(), $consulta);
            // throw $e;
        }

        return $_retorna;
    }
}