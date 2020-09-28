<?php

namespace App\Model\Mapper;

use ReflectionClass;

class MapperFactory
{
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function create($mapperClassName): Mapper
    {
        $reflMapperClass = new \ReflectionClass('\\App\\Model\\Mapper\\' . $mapperClassName);
        return $reflMapperClass->newInstance($this->connection);
    }
}