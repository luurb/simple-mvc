<?php declare(strict_types=1);

namespace Tests\Unit;

use App\Core\App;
use App\Core\Config;
use App\Core\Database;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    private $app;

    protected function setUp(): void
    {
        $this->app = App::getInstance();
    }
    
    public function test_get_same_instance_of_app(): void
    {
        $app = App::getInstance();
        $app2 = App::getInstance();

        $this->assertSame($app, $app2);
    }

    public function test_run_function_throws_exception(): void
    {
        $this->assertEquals(false, $this->app->run('GET', '/test'));
    }

    public function test_return_database_object(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $this->app->setConf(new Config($_ENV));
        $this->assertEquals(Database::class, $this->app->getDatabase()::class);
    }
}