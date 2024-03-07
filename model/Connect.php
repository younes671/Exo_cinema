<?php
    namespace Model;

    // abstract :  Les méthodes définies comme abstraites déclarent simplement la signature de la méthode ; elles ne peuvent définir son implémentation.
    abstract class Connect
    {
        const HOST_NAME = 'localhost';
        const DB_NAME = 'cinema';
        const USER_NAME = 'root';
        const PWD = '';

        // Le mot-clé static permet de définir une méthode statique d'une classe. Les méthodes statiques ne sont pas disponibles sur les instances d'une classe mais sont appelées sur la classe elle-même

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

    // PDO / mySQLi => PDO peu interagir avec plusieur type de base de donnée alors que mysqli interagi qu'avec MySQL