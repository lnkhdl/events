<?php
declare(strict_types=1);

namespace App\Model\Service;

use App\Core\PdoStorage;
use App\Model\Mapper\Mapper;

abstract class Service
{
    protected $storage;
    protected $mapper;

    public function __construct(PdoStorage $storage, Mapper $mapper)
    {
        $this->storage = $storage;
        $this->mapper = $mapper;
    }
}