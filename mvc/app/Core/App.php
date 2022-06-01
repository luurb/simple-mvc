<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exceptions\RouteNotFoundException;

class App
{
    private static ?App $app = null;
    private ?Config $config = null;
    private ?Database $db = null;
    private Router $router;

    private function __construct()
    {
        $this->router = new Router();
    }

    public static function getInstance(): self
    {
        if (is_null(self::$app)) {
            self::$app = new self();
        }

        return self::$app;
    }

    public function run(string $method, string $uri): void
    {
        try {
            echo $this->router->resolve($method, $uri);
        } catch (RouteNotFoundException $e) {
            http_response_code(404);
            echo '404 not found';
        }
    }

    public function getDatabase(): Database
    {
        if (is_null($this->db)) {
            $this->db = new Database($this->config->db);
        }

        return $this->db;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function setConf(Config $conf): void
    {
        $this->config = $conf;
    }

    public function getConf(): Config
    {
        if (is_null($this->config)) {
            $this->config = new Config();
        }

        return $this->config;
    }
}
