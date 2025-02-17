<?php
ini_set('default_charset', 'UTF-8');

session_start();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$autoload = function($class) {
    include('src/class/'.$class.'.php');
};

spl_autoload_register($autoload);

define('INCLUDE_PATH','http://localhost/Pessoal/Controle-de-notas/');

define('HOST','localhost');
define('USER','root');
define('PASS','wizard');
define('DB','universidade');

Conn::Conectar();
?>