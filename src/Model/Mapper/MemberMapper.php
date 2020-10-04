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

    public function fetchById(int $id)
    {
        $sql = 'SELECT * FROM member WHERE id = :id LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Model\Entity\MemberEntity');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert(array $data)
    {
        $sql = "INSERT INTO member (first_name, last_name, email, event_id)
                VALUES (:first_name, :last_name, :email, :event_id)";
        $stmt= $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(array $data)
    {
        $sql = "UPDATE member
                SET first_name = :first_name, last_name = :last_name, email = :email
                WHERE id = :id";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindValue(':first_name', $data['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $data['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function doesEmailExists(int $event_id, string $email)
    {
        $sql = 'SELECT 1 FROM member WHERE event_id = :event_id AND email = :email';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return ($result === '1');
    }

    public function doesOtherMemberWithEmailExist(int $event_id, int $id, string $email)
    {
        $sql = 'SELECT 1 FROM member WHERE event_id = :event_id AND email = :email AND id <> :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return ($result === '1');
    }

    public function delete(int $id): int
    {
        $sql = 'DELETE FROM member WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}