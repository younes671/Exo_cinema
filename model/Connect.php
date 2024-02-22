<?php
    namespace Model;
    abstract class Connect
    {
        const HOST_NAME = 'localhost';
        const DB_NAME = 'cinema';
        const USER_NAME = 'root';
        const PWD = '';

    public static function seConnecter()
    {
        try
        {
            return new \PDO
            (
                'mysql:host=' . self::HOST_NAME . ';dbname=' . self::DB_NAME .';
                charset=utf8', self::USER_NAME, self::PWD
            );
        }
        catch(\PDOException $e)
        {
            $msg = 'Erreur de connexion à la DB' . $e->getMessage();
            die($msg);
        }

    }

    }