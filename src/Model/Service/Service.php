<?php
declare(strict_types=1);

namespace App\Model\Service;

use App\Core\PdoStorage;
use App\Model\Mapper\Mapper;

abstract class Service
{
    protected $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }
}