<?php

declare(strict_types=1);

namespace App\Core;
use PDO;

class Database 
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $this->pdo = new PDO(
            $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['name'],
            $config['user'],
            $config['password']
        );
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}