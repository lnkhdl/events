<?php

namespace App\Model\Service;

use App\Core\PdoStorage;
use App\Model\Mapper\MapperFactory;
use ReflectionClass;

class ServiceFactory
{
    private $storage;

    public function __construct(PdoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function create($serviceClassName, $mapperClassName)
    {
        $mappperFactory = new MapperFactory($this->storage->getConnection());
        $mapper = $mappperFactory->create($mapperClassName);
        $reflServiceClass = new ReflectionClass('\\App\\Model\\Service\\' . $serviceClassName);
        return $reflServiceClass->newInstance($mapper);
    }
}