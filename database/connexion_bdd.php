<?php

class Database {
    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASS = '';
    private const DB_NAME = 'clubtheatre';

    // Instance partagée pour éviter d'ouvrir plusieurs connexions
    private static ?PDO $instance = null;

    /**
     * Retourne la connexion PDO à la base de données `clubtheatre`.
     * La connexion est créée au premier appel puis réutilisée.
     */
    public function connexionBdd(): PDO {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=utf8",
                    self::USER,
                    self::PASS
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
                die();
            }
        }
        return self::$instance;
        }
    }

