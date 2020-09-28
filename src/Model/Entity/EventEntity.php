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

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date)
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

    public function entityToArray(): array
    {
        $data[] = null;
        $data['name'] = $this->getName();
        $data['city'] = $this->getCity();
        $data['address'] = $this->getAddress();
        $data['date'] = $this->getDate();
        $data['description'] = $this->getDescription();

        $data = parent::hydrateArray($data);

        return $data;
    }
}