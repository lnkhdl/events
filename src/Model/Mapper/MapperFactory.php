<?php

namespace App\Model\Mapper;

use RuntimeException;

class MapperFactory
{
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function create($mapperClassName)
    {
        $refl = new \ReflectionClass('\\App\\Model\\Mapper\\' . $mapperClassName);

        try {
            return $refl->newInstance($this->connection);
        } catch (\ReflectionException $e) {
            throw new RuntimeException("Mapper {$mapperClassName} not found.");
        }
    }
}