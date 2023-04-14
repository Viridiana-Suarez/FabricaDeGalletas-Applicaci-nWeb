<?php

    define('DB_HOST','localhost');

    define('DB_USUARIO','');

    define('DB_CONTRA','');

    define('DB_NOMBRE','fabrica_galletas');

    define('DB_CHARSET', 'utf8');

    class Conexion{

        protected $conexion_db;

        public function __construct(){

            $this->conexion_db = new mysqli(DB_HOST, DB_USUARIO, DB_CONTRA, DB_NOMBRE);

            if( $this->conexion_db->connect_errno) {
                echo "Fallo al conectar a MySQL:" . $this->conexion_db->connect_error;
                return;
            }
        }

    }

?> 