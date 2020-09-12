<?php

namespace App\Model\Service;

use App\Core\PdoStorage;
use App\Model\Mapper\MapperFactory;
use ReflectionClass;
use Exception;
use ReflectionException;

class ServiceFactory
{
    private $storage;

    public function __construct(PdoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function create($serviceClassName, $mapperClassName)
    {
        try {
            if ($this->storage->getConnection()) {
                $mappperFactory = new MapperFactory($this->storage->getConnection());
                $mapper = $mappperFactory->create($mapperClassName);
                $reflServiceClass = new ReflectionClass('\\App\\Model\\Service\\' . $serviceClassName);
                return $reflServiceClass->newInstance($mapper);
            } else {
                throw new Exception();
            }
        } catch (ReflectionException $e) {
            //echo $e->getMessage();
            echo "Unexpected error happened.\r\n";
            die();
        } catch (Exception $e) {
            // echo $e->getMessage();
            echo "Unexpected error happened.\r\n";
            die();
        }
    }
}