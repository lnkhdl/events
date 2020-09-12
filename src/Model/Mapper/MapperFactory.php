<?php

namespace App\Model\Mapper;

class MapperFactory
{
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function create($mapperClassName)
    {
        $reflMapperClass = new \ReflectionClass('\\App\\Model\\Mapper\\' . $mapperClassName);
        return $reflMapperClass->newInstance($this->connection);
    }
}