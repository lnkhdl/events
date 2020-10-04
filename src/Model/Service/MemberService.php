<?php
declare(strict_types=1);

namespace App\Model\Service;

class MemberService extends Service
{
    public function getMembersByEventId(int $id): array
    {
        return $this->mapper->fetchByEventId($id);
    }

    public function getMemberById(int $id)
    {
        return $this->mapper->fetchById($id);
    }

    public function saveMember(array $data): void
    {
        if (!$this->mapper->doesEmailExists((int)$data['event_id'], $data['email'])) {
            unset($data['event_name']);
            if ($this->mapper->insert($data)) {
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
        if (!$this->mapper->doesOtherMemberWithEmailExist((int)$data['event_id'], (int)$data['id'], $data['email'])) {
            if ($this->mapper->update($data)) {
                $this->message['success'] = 'Member updated.';
            } else {
                $this->message['error'] = 'Error when updating member.';
            }
        } else {
            $this->message['error'] = "Member with email '{$data['email']}' already exists.";
        }
    }

    public function deleteMember(int $id): void
    {
        if ($this->mapper->delete($id) === 1) {
            $this->message['success'] = 'Member deleted.';
        } else {
            $this->message['error'] = 'Error when removing member.';
        }
    }

}