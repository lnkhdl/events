<?php
declare(strict_types=1);

namespace App\Model\Mapper;

use PDO;

class MemberMapper extends Mapper
{    
    public function fetchByEventId(int $eventId): array
    {
        $sql = 'SELECT * FROM member WHERE event_id = :eventId';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Model\Entity\MemberEntity');  
    }
}