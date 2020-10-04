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

    public function insert(array $data)
    {
        $sql = "INSERT INTO event (name, city, address, date, description)
                VALUES (:name, :city, :address, :date, :description)";
        $stmt= $this->connection->prepare($sql);
        // execute() returns true on success
        return $stmt->execute($data);
    }

    public function update(array $data)
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
        return $stmt->execute();
    }

    public function doesEventNameExist(string $name)
    {
        $sql = 'SELECT 1 FROM event WHERE name = :name';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return ($result === '1');
    }

    public function doesOtherEventWithNameExist(string $name, int $id)
    {
        $sql = 'SELECT 1 FROM event WHERE name = :name AND id <> :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return ($result === '1');
    }

    public function delete(int $id): int
    {
        $sql = 'DELETE FROM event WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}