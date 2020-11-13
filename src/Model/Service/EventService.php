<?php
declare(strict_types=1);

namespace App\Model\Service;

class EventService extends Service
{
    public $message = [
        'success' => null,
        'error' => null
    ];

    public function getEventById(int $id)
    {
        return $this->mapper->fetchById($id);
    }

    public function getEventByName(string $name)
    {
        return $this->mapper->fetchByName($name);
    }

    public function getEventNameById(int $id)
    {
        return $this->mapper->fetchEventNameById($id);
    }

    public function getAllEvents(): array
    {
        return $this->mapper->fetchAll();
    }

    public function getLatestEvents(): array
    {
        return $this->mapper->fetchLatest(8);
    }

    public function saveEvent(array $data): void
    {
        if ($this->mapper->doesEventNameExist($data['name']) === 0) {
            $data['date'] = $this->convertDateToDbFormat($data['date']);
            if ($this->mapper->insert($data) === 1) {
                $this->message['success'] = 'Event saved.';
            } else {
                $this->message['error'] = 'Error when saving event.';
            }
        } else {
            $this->message['error'] = "Event with name '{$data['name']}' already exists.";
        }
    }

    public function updateEvent(array $data): void
    {
        if ($this->mapper->doesOtherEventWithNameExist($data['name'], (int)$data['id']) === 0) {
            $data['date'] = $this->convertDateToDbFormat($data['date']);
            $result = $this->mapper->update($data);
            if ($result === 1) {
                $this->message['success'] = 'Event updated.';
            } elseif ($result === 0) {
                $this->message['error'] = 'Nothing has changed.';
            } else {
                $this->message['error'] = 'Error when updating event.';
            }
        } else {
            $this->message['error'] = "Event with name '{$data['name']}' already exists.";
        }
    }

    public function deleteEvent(int $id): void
    {
        if ($this->mapper->delete($id)) {
            $this->message['success'] = 'Event deleted.';
        } else {
            $this->message['error'] = 'Error when removing event.';
        }
    }
}