<?php
define('BASE_DE_DATOS', 'MYSQL');

switch (BASE_DE_DATOS) {

    case 'MYSQL':
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'mipicada');
        define('DB_USER', 'user_mipicada');
        define('DB_PASS', 'mipicada');

        define('CHARSET','UTF-8');
        define('DB_SHOW_ERRORS',FALSE); // Show DB connection error to users?
        define('DB_DATASIZE',FALSE); // NOT recommended for large queries! Haves an significant impact on speed!!
        define('DB_LOG_XML',FALSE); // Log all database activity to XML?
        define('DB_URL_XML', DR . '/log/sql/db-log.xml'); // Location of XML file, recommended place is outside the public_html directory!
        define('DB_CACHE_LOCATION','cache/'); // Location of cache file(s), with trailing slash
        define('DB_CACHE_EXPIRE','30'); // DB cache file expiricy, in seconds

        define('MYSQL_HOST', 'localhost'); // your db's host
        define('MYSQL_PORT', 3306);        // your db's port
        define('MYSQL_USER', 'user_mipicada'); // your db's username
        define('MYSQL_PASS', 'mipicada'); // your db's password
        define('MYSQL_NAME', 'mipicada');   // your db's database name
        define('DBCHAR', 'latin1'); // The DB's charset
        break;

    case 'POSTGRES':
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'mipicada');
        define('DB_USER', 'user_mipicada');
        define('DB_PASS', 'mipicada');
        break;

    default:
        # code...
        break;
}
