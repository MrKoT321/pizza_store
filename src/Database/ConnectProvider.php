<?php

namespace App\Database;

class ConnectionProvider {
    public static function connectDatabase(): \PDO
    {
        $dsn = 'mysql:host=localhost:3306;dbname=pizza_shop;charset=utf8';
        $user = 'root';
        $password = '1234';
        return new \PDO($dsn, $user, $password);
    }
}