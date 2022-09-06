<?php
    class Conn
    {
        private static $PDO;

        public static function Conectar()
        {
            if(self::$PDO == null)
            {
                try
                {
                    self::$PDO = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    self::$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }
                catch(Exception $e)
                {
                    include('pages/erroConexao.php');
                    die();
                }
            }

            return self::$PDO;
        }
    }
?>