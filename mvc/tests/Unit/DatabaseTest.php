<?php declare(strict_types=1);

namespace Tests\Unit;

use App\Core\Config;
use App\Core\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function test_pdo_exception_is_throwed(): void
    {
        $this->expectException(\Exception::class);
        $config = new Config([]);
        new Database($config->db);
    }

    public function test_return_PDO_object(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $config = new Config($_ENV);
        $database = new Database($config->db);

        $this->assertInstanceOf(\PDO::class, $database->getPDO());
    }
}