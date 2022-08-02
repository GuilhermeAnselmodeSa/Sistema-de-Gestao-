<?php

class Conexao
{
    static function connect()
    {
        try {
            $usuario = "root";
            $senha = "";
            $servidor = "localhost";
            $bd = "adega";
            $pdo = new PDO(
                "mysql:host=" . $servidor . ";dbname=" . $bd,
                $usuario,
                $senha,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "
                SET NAMES utf8")
            );
            return $pdo;
        } catch (Exception $e) {
            echo "Erro generico: " . $e->getMessage();
            return false;
        }
    }
}
?>