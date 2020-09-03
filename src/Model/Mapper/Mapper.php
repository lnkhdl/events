<?php
declare(strict_types=1);

namespace App\Model\Mapper;

abstract class Mapper
{
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
}