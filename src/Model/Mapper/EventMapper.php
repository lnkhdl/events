<?php
declare(strict_types=1);

namespace App\Model\Mapper;

use PDO;
use PDOException;

class EventMapper extends Mapper
{    
    public function fetchById(int $id)
    {
        try {
            $sql = 'SELECT * FROM event WHERE id = :id LIMIT 1';
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Model\Entity\EventEntity');
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fetchByName(string $name)
    {
        try {
            $sql = 'SELECT * FROM event WHERE name = :name LIMIT 1';
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Model\Entity\EventEntity');
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fetchAll(): array
    {
        try {
            $sql = 'SELECT * FROM event';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Model\Entity\EventEntity');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }      
    }

    public function insert(array $data)
    {
        try {
            $sql = "INSERT INTO event (name, city, address, date, description) VALUES (:name, :city, :address, :date, :description)";
            $stmt= $this->connection->prepare($sql);
            // execute() returns true on success
            return $stmt->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            // save into traces $stmt->errorInfo();
        }
    }

    public function update(array $data)
    {
        var_dump($data);
        try {
            $sql = "UPDATE event SET name = :name, 
                                     city = :city,
                                     address = :address,
                                     date = :date, 
                                     description = :description
                                 WHERE id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':city', $data['city'], PDO::PARAM_STR);
            $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindValue(':date', $data['date'], PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindValue(':id', $data['id'], PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function doesEventNameExist(string $name)
    {
        try {
            $sql = 'SELECT 1 FROM event WHERE name = :name';
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return ($result === '1');
    }

    public function doesOtherEventWithNameExist(string $name, int $id)
    {
        try {
            $sql = 'SELECT 1 FROM event WHERE name = :name AND id <> :id';
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return ($result === '1');
    }

    public function delete(int $id)
    {
        try {
            $sql = 'DELETE FROM event WHERE id = :id';
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}