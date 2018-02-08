<?php

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
    public static function make()
    {
        return new PDO(
            'mysql:host=127.0.0.1;dbname=' . $_ENV['DATABASE'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PSSWD'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}

