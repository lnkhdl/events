<?php
declare(strict_types=1);

namespace App\Model\Mapper;

use PDO;

class EventMapper extends Mapper
{    
    public function fetchById(int $id)
    {
        $sql = 'SELECT * FROM event WHERE id = :id LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Model\Entity\EventEntity');
        $stmt->execute();
        // Returns EventEntity or false if nothing found - exception is handled in the controller
        return $stmt->fetch();
    }

    public function fetchByName(string $name)
    {
        $sql = 'SELECT * FROM event WHERE name = :name LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Model\Entity\EventEntity');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function fetchEventNameById(int $id)
    {
        $sql = 'SELECT name FROM event WHERE id = :id LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function fetchAll(): array
    {
        $sql = 'SELECT * FROM event';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Model\Entity\EventEntity');    
    }

    public function fetchLatest(int $count): array
    {
        $sql = 'SELECT * FROM event ORDER BY created_at DESC LIMIT :count';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Model\Entity\EventEntity');    
    }

    public function insert(array $data): int
    {
        $sql = "INSERT INTO event (name, city, address, date, description)
                VALUES (:name, :city, :address, :date, :description)";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function update(array $data): int
    {
        $sql = "UPDATE event
                SET name = :name, city = :city, address = :address, date = :date, description = :description
                WHERE id = :id";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'], PDO::PARAM_STR);
        $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
        $stmt->bindValue(':date', $data['date'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function doesEventNameExist(string $name): int
    {
        $sql = 'SELECT 1 FROM event WHERE name = :name';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function doesOtherEventWithNameExist(string $name, int $id): int
    {
        $sql = 'SELECT 1 FROM event WHERE name = :name AND id <> :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete(int $id): bool
    {
        $this->connection->beginTransaction();

        $sqlMember = 'DELETE FROM member WHERE event_id = :event_id';
        $stmtMember = $this->connection->prepare($sqlMember);
        $stmtMember->bindValue(':event_id', $id, PDO::PARAM_INT);
        $stmtMember->execute();

        $sqlEvent = 'DELETE FROM event WHERE id = :id';
        $stmtEvent = $this->connection->prepare($sqlEvent);
        $stmtEvent->bindValue(':id', $id, PDO::PARAM_INT);
        $stmtEvent->execute();
        
        if ($stmtEvent->rowCount() === 1) {
            $this->connection->commit();
            return true;
        } else {
            $this->connection->rollBack();
            return false;
        }
    }
}