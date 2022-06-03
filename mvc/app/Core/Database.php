<?php

declare(strict_types=1);

namespace App\Core;
use PDO;

class Database 
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        try {
            $this->pdo = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['name'],
                $config['user'],
                $config['password']
            );
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}