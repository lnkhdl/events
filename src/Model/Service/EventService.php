<?php
declare(strict_types=1);

namespace App\Model\Service;

use DateTime;

class EventService extends Service
{
    public function getEventById(int $id)
    {
        return $this->mapper->fetchById($id); 
    }

    public function getEventByName(string $name)
    {
        return $this->mapper->fetchByName($name);
    }

    public function getAllEvents(): array
    {
        return $this->mapper->fetchAll();
    }

    public function saveEvent(array $data): array
    {
        $message = [];

        if (!$this->mapper->doesEventNameExist($data['name'])) {
            $data['date'] = $this->convertDateToDbFormat($data['date']);
            if ($this->mapper->insert($data)) {
                $message = ['message' => "Event saved."];
            } else {
                $message = ['error' => "Error when saving into database."];
            }
        } else {
            $message = ['error' => "Event with name '{$data['name']}' already exists."];
        }

        return $message;
    }

    private function convertDateToDbFormat(string $date): ?string
    {
        $dateFromString = date_create_from_format('d-m-Y H:i', $date);
        return date_format($dateFromString, 'Y-m-d H:i:s');
    }

}