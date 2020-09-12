<?php

declare(strict_types=1);

namespace App\Model\Entity;

use DateTime;

abstract class Entity
{
    public $id;
    public $created_at;
    public $updated_at;

    public function getId(): int
    {
        return (int)$this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $date)
    {
        $this->created_at = $date;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $date)
    {
        $this->updated_at = $date;
    }
}
