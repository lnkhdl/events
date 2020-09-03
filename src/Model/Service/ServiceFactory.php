<?php

namespace App\Model\Service;

use App\Core\PdoStorage;
use App\Model\Mapper\MapperFactory;
use RuntimeException;

class ServiceFactory
{
    private $storage;

    public function __construct(PdoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function create($serviceClassName, $mapperClassName)
    {
        $refl = new \ReflectionClass('\\App\\Model\\Service\\' . $serviceClassName);

        $mappperFactory = new MapperFactory($this->storage->db);
        $mapper = $mappperFactory->create($mapperClassName);

        try {
            return $refl->newInstance($this->storage, $mapper);
        } catch (\ReflectionException $e) {
            throw new RuntimeException("Service {$serviceClassName} not found.");
        }
    }
}