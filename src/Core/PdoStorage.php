<?php

namespace App\Core;

use PDO;
use PDOException;

class PdoStorage
{
    private $env;
    private $connection;

    public function __construct(string $env)
    {
        $this->env = $env;
    }

    private function getPdoParameters(): array
    {
        $dbConfig = require Config::get('DATABASE_DETAILS');

        return [
            'dsn' => 'mysql:host=' . $dbConfig[$this->env . '_DB_HOST'] . ';dbname=' . $dbConfig[$this->env . '_DB_NAME'] . ';charset=utf8',
            'user' => $dbConfig[$this->env . '_DB_USER'],
            'password' => $dbConfig[$this->env . '_DB_PASS'],
            'options' => [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_CASE => PDO::CASE_LOWER
            ]
        ];
    }

    public function getConnection(): ?PDO
    {
        $parameters = $this->getPdoParameters();

        try {
            $this->connection = new PDO($parameters['dsn'], $parameters['user'], $parameters['password'], $parameters['options']);
            return $this->connection;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}