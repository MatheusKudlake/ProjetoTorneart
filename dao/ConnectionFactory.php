<?php
class ConnectionFactory
{
    static $connection;

    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            $host = "localhost";
            $dbName = "torneart";
            $user = "root";
            $pass = "";
            $port = 3306;

            try {
                self::$connection = new PDO("mysql:host=$host;dbname=$dbName;port=$port", $user, $pass);
            } catch (PDOException $erro) {
                echo "Erro ao conectar no banco: $erro";
            }
        }
        return self::$connection;
    }
}
