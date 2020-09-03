<?php
declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Entity\EventEntity;
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

    public function insert(array $data): bool
    {
/*
        $data = [
            'name' => "Test 04 from code",
            'city' => "České Budějovice",
            'address' => "Adresa 123",
            'date' => "2022-12-30 18:00",
            'description' => ''
        ];
*/
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

    public function doesEventNameExist(string $name): bool
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
}