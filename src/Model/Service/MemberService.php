<?php
declare(strict_types=1);

namespace App\Model\Service;

class MemberService extends Service
{
    public function getMembersByEventId(int $id): array
    {
        return $this->mapper->fetchByEventId($id);
    }

    public function getMemberByIdAndEventId(int $id, int $event_id)
    {
        return $this->mapper->fetchByIdAndEventId($id, $event_id);
    }

    public function saveMember(array $data): void
    {
        if ($this->mapper->doesEmailExists((int)$data['event_id'], $data['email']) === 0) {
            unset($data['event_name']);
            if ($this->mapper->insert($data) === 1) {
                $this->message['success'] = 'Member saved.';
            } else {
                $this->message['error'] = 'Error when saving member.';
            }
        } else {
            $this->message['error'] = "Member with email '{$data['email']}' already exists.";
        }
    }

    public function updateMember(array $data): void
    {
        if ($this->mapper->doesOtherMemberWithEmailExist((int)$data['event_id'], (int)$data['id'], $data['email']) === 0) {
            $result = $this->mapper->update($data);
            if ($result === 1) {
                $this->message['success'] = 'Member updated.';
            } elseif ($result === 0) {
                $this->message['error'] = 'Nothing has changed.';
            } else {
                $this->message['error'] = 'Error when updating member.';
            }
        } else {
            $this->message['error'] = "Member with email '{$data['email']}' already exists.";
        }
    }

    public function deleteMember(int $id): void
    {
        $result = $this->mapper->deleteMember($id);
        if ($result === 1) {
            $this->message['success'] = 'Member deleted.';
        } elseif ($result === 0) {
            $this->message['error'] = 'Member does not exist.';
        } else {
            $this->message['error'] = 'Error when removing member.';
        }
    }
}