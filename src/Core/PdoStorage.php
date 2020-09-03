<?php

namespace App\Core;

use PDO;

class PdoStorage
{
    public $db;

    public function __construct(string $host, string $dbname, string $user, string $password)
    {
        $dsn = 'mysql:host=' . $host . ';charset=utf8;dbname=' . $dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_CASE => PDO::CASE_LOWER
        );

        //Create PDO Instance
        try {
            $this->db = new PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}