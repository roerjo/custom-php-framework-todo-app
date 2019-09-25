<?php

namespace App\Database;

use PDO;

/**
 * Class: Connection
 *
 */
class Connection
{
    /**
     * Creates a new PDO connection
     *
     * @return PDO
     */
    public static function make(): PDO
    {
        switch ($_ENV['DATABASE_DRIVER']) {
            case 'mysql':
                $dsn = 'mysql:host='.$_ENV['DATABASE_HOST'].';dbname='.$_ENV['DATABASE'];
                break;
            case 'sqlite':
                $dsn = 'sqlite:'.$_ENV['DATABASE_DATABASE'];
                break;
        }

        return new PDO(
            $dsn,
            $_ENV['DATABASE_USER'] ?? null,
            $_ENV['DATABASE_PASSWORD'] ?? null,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}
