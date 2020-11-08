<?php
declare(strict_types=1);

namespace App\Model\Service;

use App\Core\PdoStorage;
use App\Model\Mapper\Mapper;

abstract class Service
{
    protected $mapper;
    public $message = [];

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function convertDateToDbFormat(string $date): ?string
    {
        $dateFromString = date_create_from_format('Y-m-d\TH:i', $date);
        return date_format($dateFromString, 'Y-m-d H:i:s');
    }

    public function convertDateToFormFormat(string $date): ?string
    {
        $dateFromString = date_create_from_format('Y-m-d H:i:s', $date);
        return date_format($dateFromString, 'Y-m-d\TH:i');
    }
}