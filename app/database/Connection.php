<?php

namespace App\Database;

use PDO;

class Connection
{
    /**
     * Creates a new PDO connection.
     *
     * @return PDO
     */
    public static function make(): PDO
    {
        switch ($_ENV['DATABASE_DRIVER']) {
            case 'mysql':
                $dsn = 'mysql:host='.$_ENV['DATABASE_HOST'].';dbname='.$_ENV['DATABASE_DATABASE'];
                $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
                break;
            case 'sqlite':
                $dsn = 'sqlite:'.$_ENV['DATABASE_HOST'];
                $options = [PDO::ATTR_PERSISTENT => true];
                break;
        }

        return new PDO(
            $dsn,
            $_ENV['DATABASE_USER'] ?? null,
            $_ENV['DATABASE_PASSWORD'] ?? null,
            $options
        );
    }
}
