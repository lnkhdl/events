<?php

namespace App\Core;

use PDO;
use PDOException;

class PdoStorage
{
    private $connection;
    private $dsn;
    private $user;
    private $password;
    private $options = [];

    public function __construct(string $host, string $dbname, string $user, string $password)
    {
        $this->dsn = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8';
        $this->user = $user;
        $this->password = $password;
        $this->options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_CASE => PDO::CASE_LOWER
        ];
    }

    public function getConnection()
    {
        try {
            $this->connection = new PDO($this->dsn, $this->user, $this->password, $this->options);
            return $this->connection;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}