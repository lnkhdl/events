<?php
declare(strict_types=1);

namespace App\Model\Entity;

class EventEntity extends Entity
{
    private $name;
    private $city;
    private $address;
    private $date;
    private $description;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EventEntity
    {
        $this->name = $name;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): EventEntity
    {
        $this->city = $city;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): EventEntity
    {
        $this->address = $address;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): EventEntity
    {
        $this->date = $date;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): EventEntity
    {
        $this->description = $description;
        return $this;
    }

    public function entityToArray(bool $specificOnly = false): array
    {
        $data = [];
        $data['name'] = $this->getName();
        $data['city'] = $this->getCity();
        $data['address'] = $this->getAddress();
        $data['date'] = $this->getDate();
        $data['description'] = $this->getDescription();

        if (!$specificOnly) {
            $data = parent::hydrateArray($data);
        }

        return $data;
    }
}