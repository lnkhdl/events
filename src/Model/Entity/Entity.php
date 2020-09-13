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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $date)
    {
        $this->created_at = $date;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $date)
    {
        $this->updated_at = $date;
    }

    public function hydrateArray(Entity $entity, array $data)
    {
        $data['id'] = $entity->getId();
        $data['created_at'] = $entity->getCreatedAt();
        $data['updated_at'] = $entity->getUpdatedAt();

        return $data;
    }
}
