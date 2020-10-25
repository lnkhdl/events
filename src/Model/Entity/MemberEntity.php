<?php
declare(strict_types=1);

namespace App\Model\Entity;

class MemberEntity extends Entity
{
    private $first_name;
    private $last_name;
    private $email;
    private $event_id;

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): MemberEntity
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): MemberEntity
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): MemberEntity
    {
        $this->email = $email;
        return $this;
    }

    public function getEventId(): string
    {
        return $this->event_id;
    }

    public function setEventId(string $event_id): MemberEntity
    {
        $this->event_id = $event_id;
        return $this;
    }

    public function entityToArray(bool $specificOnly = false): array
    {
        $data = [];
        $data['first_name'] = $this->getFirstName();
        $data['last_name'] = $this->getLastName();
        $data['email'] = $this->getEmail();
        $data['event_id'] = $this->getEventId();

        if (!$specificOnly) {
            $data = parent::hydrateArray($data);
        }

        return $data;
    }
}