<?php

declare(strict_types=1);

namespace App\Model\Entity;

use DateTime;

abstract class Entity
{
    public $id;
    public $created_at;
    public $updated_at;

    abstract public function arrayToEntity(array $data, $entity): void;
    abstract public function entityToArray($entity, array $data): array;

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

    protected function hydrateEntity(array $data, Entity $entity)
    {
        $entity->setId($data['id']);
        $entity->setCreatedAt(new DateTime($data['created_at']));
        $entity->setUpdatedAt(new DateTime($data['updated_at']));
    }

    protected function hydrateArray(Entity $entity, array $data)
    {
        $data['id'] = strval($entity->getId());
        $data['created_at'] = date_format($entity->getCreatedAt(), 'd/m/Y H:i:s');
        $data['updated_at'] = date_format($entity->getUpdatedAt(), 'd/m/Y H:i:s');

        return $data;
    }
}
