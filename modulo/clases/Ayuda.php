<?php
abstract class Ayuda {

    public static function iniciaSesion()
    {
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            session_status() === PHP_SESSION_ACTIVE ? '' : session_start() ;
        } else {
            session_id() === '' ? session_start() : '' ;
        }
    }
}
