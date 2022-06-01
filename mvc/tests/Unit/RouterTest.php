<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Core\Exceptions\ControllerNotFoundException;
use App\Core\Exceptions\MethodNotFoundException;
use App\Core\Router;
use PHPUnit\Framework\TestCase;
use App\Core\Exceptions\RouteNotFoundException;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }

    public function testGet(): void
    {
        $this->router->get('/home', ['Home', 'index']);
        $expected = [
            'GET' => [
                '/home' => ['Home', 'index']
            ]
        ];

        $this->assertEquals($expected, $this->router->getRoutes());
    }

    public function testPost(): void
    {
        $this->router->post('/store', ['Product', 'store']);
        $expected = [
            'POST' => [
                '/store' => ['Product', 'store']
            ]
        ];

        $this->assertEquals($expected, $this->router->getRoutes());
    }

    public function testGetRoutes(): void
    {
        $router = new Router();
        $this->assertEmpty($router->getRoutes());
    }

    public function testCallUserFunc(): void
    {
        $this->router->post('/product', fn() => 2);
        $this->assertSame(2, $this->router->resolve('POST', '/product'));

    }

    public function testCallUserFuncArr(): void
    {
        $product = new class {
            public function index()
            {
                return 2;
            }
        };

        $this->router->get('/product', [$product::class, 'index']);
        $this->assertSame(2, $this->router->resolve('GET', '/product'));
    }

    public function testRouteNotFoundException(): void
    {
        $this->router->get('/product', ['Product', 'index']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve('GET', '/store');

    }

    public function testMethodNotFoundException(): void
    {
        $product = new class {
            public function index()
            {
                return 2;
            }
        };

        $this->router->get('/product', [$product::class, 'indeex']);

        $this->expectException(MethodNotFoundException::class);
        $this->router->resolve('GET', '/product');

    }

    public function testControllerNotFoundException(): void
    {
        $this->router->post('/product', ['Product', 'store']);

        $this->expectException(ControllerNotFoundException::class);
        $this->router->resolve('POST', '/product');

    }
}
