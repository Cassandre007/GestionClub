<?php

declare(strict_types=1);

class Database
{
    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASS = '';
    private const DB_NAME = 'clubtheatre';

    private static ?PDO $instance = null;

    public static function connexionBdd(): PDO
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host='.self::HOST.';dbname='.self::DB_NAME.';charset=utf8',
                    self::USER,
                    self::PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die('Erreur de connexion : '.$e->getMessage());
            }
        }
        return self::$instance;
    }
}
