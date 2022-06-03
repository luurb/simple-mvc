<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Core\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase 
{
    public function test_config_array_returns_null(): void
    {
        $config = new Config();
        $this->assertSame(null, $config->test);
    }

    public function test_return_correct_config_array(): void
    {
        $config = new Config(['DB_USERNAME' => 'test']);
        $this->assertSame('test', $config->db['user']);
    }
}