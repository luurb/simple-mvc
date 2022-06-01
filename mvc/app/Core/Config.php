<?php

declare(strict_types=1);

namespace App\Core;

class Config 
{
    protected array $config = [];

    public function __construct(array $env = [])
    {
        $this->config = [
            'db' => [
                'driver' => $env['DB_CONNECTION'] ?? 'mysql',
                'host' => $env['DB_HOST'] ?? 'root',
                'name' => $env['DB_DATABASE'] ?? 'mvc',
                'user' => $env['DB_USERNAME'] ?? 'root',
                'password' => $env['DB_PASSWORD'] ?? 'root',
            ],
        ];
    }

    public function __get($name): array|null
    {
        return $this->config[$name] ?? null;
    }

}