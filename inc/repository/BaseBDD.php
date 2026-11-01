<?php

abstract class BaseBDD {
    protected static function pdo(): PDO {
        return Database::connexionBdd();
    }
}
