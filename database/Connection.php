<?php


class Connection
{

    public static function make()
    {
        
        return new PDO(
            'mysql:host=127.0.0.1;dbname=todo1',
            'root',
            '08frontier',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

    }

}
