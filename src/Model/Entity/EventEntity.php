<?php
declare(strict_types=1);

namespace App\Model\Entity;

use DateTime;

class EventEntity extends Entity
{
    public $name;
    public $city;
    public $address;
    public $date;
    public $description;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function arrayToEntity(array $data, $entity): void
    {
        $entity->setName($data['name']);
        $entity->setCity($data['city']);
        $entity->setAddress($data['address']);
        $entity->setDate(new DateTime($data['date']));
        $entity->setDescription($data['description']);

        parent::hydrateEntity($data, $entity);
    }

    public function entityToArray($entity, array $data): array
    {
        $data['name'] = $entity->getName();
        $data['city'] = $entity->getCity();
        $data['address'] = $entity->getAddress();
        $data['date'] = date_format($entity->getDate(), 'd/m/Y H:i:s');
        $data['description'] = $entity->getDescription();

        $data = parent::hydrateArray($entity, $data);

        return $data;
    }
}