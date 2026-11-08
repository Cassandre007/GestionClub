<?php

declare(strict_types=1);

abstract class BaseBDD
{
    protected static function pdo(): PDO
    {
        return Database::connexionBdd();
    }
}
