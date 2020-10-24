<?php

declare(strict_types=1);

namespace App\Model\Entity;

abstract class Entity
{
    protected $id;
    protected $created_at;
    protected $updated_at;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Entity
    {
        $this->id = $id;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $date): Entity
    {
        $this->created_at = $date;
        return $this;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $date): Entity
    {
        $this->updated_at = $date;
        return $this;
    }

    public function hydrateArray(array $data)
    {
        $data['id'] = $this->getId();
        $data['created_at'] = $this->getCreatedAt();
        $data['updated_at'] = $this->getUpdatedAt();

        return $data;
    }
}
