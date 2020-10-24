<?php
declare(strict_types=1);

namespace App\Model\Mapper;

abstract class Mapper
{
    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
}