<?php
class Conexion {

    private $_manejador = false;
    private $_logRuta = DIRECTORIO_RAIZ . SEPARADOR_DIRECTORIO .'logs' . SEPARADOR_DIRECTORIO . 'sql';

    public function __construct()
    {
        $this->conectar();
    }

    public function __destruct()
    {
        pg_close($this->_manejador);
    }

    public function getConexion()
    {
        return $this->_manejador;
    }

    private function conectar()
    {
        try {

            $this->_manejador = pg_connect(
                'host=' . DB_HOST .
                ' dbname=' . DB_NAME .
                ' user=' . DB_USER .
                ' password=' . DB_PASS
            );

            if (!$this->_manejador) {
                throw new Exception('Error en la conexion con la db.', 901);

            }
        } catch (Exception $e) {
            $this->escribeLog($e);
        }
    }

    public function escribeLog($texto = '', $ultimaConsulta = '')
    {
        if (empty($texto)) {
            $texto = pg_last_error();
        }

        if (!empty($ultimaConsulta)) {
            $texto .= $ultimaConsulta;
        }

        $reg = SALTO_LINEA . date('d-m-Y H:i:s', time()) . ' - ' . $texto . SALTO_LINEA;

        $nombre_archivo = ($this->_logRuta . SEPARADOR_DIRECTORIO . date('Ymd', time()) . '.log');

        $arch = fopen($nombre_archivo, 'a');

        if ($arch) {
            fwrite($arch, $reg);
        }
    }
}