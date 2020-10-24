<?php

namespace Helper;

use App\Core\PdoStorage;
use App\Model\Mapper\MapperFactory;
use App\Model\Mapper\Mapper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Integration extends \Codeception\Module
{
    private $env = 'TEST';
    private $documentRoot = 'C:\\xampp\htdocs\\+Projects\\PHP\\PHP_MyEvents\\';

    public function createMapper(string $mapperName): Mapper
    {
        $_SERVER['DOCUMENT_ROOT'] = $this->documentRoot;
        $pdoStorage = new PdoStorage($this->env);
        $connection = $pdoStorage->getConnection();
        $mapperFactory = new MapperFactory($connection);
        $mapper = $mapperFactory->create($mapperName);
        return $mapper;
    }
}
