<?php
declare(strict_types=1);

namespace App\Model\Service;

class MemberService extends Service
{
    public function getMembersByEventId(int $id): array
    {
        return $this->mapper->fetchByEventId($id);
    }

}