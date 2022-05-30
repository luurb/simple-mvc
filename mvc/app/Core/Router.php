<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exceptions\RouteNotFoundException;
use App\Core\Exceptions\MethodNotFoundException;
use App\Core\Exceptions\ControllerNotFoundException;

class Router 
{
    private array $routes;

    private function register(string $method, string $path, callable|array $action): self
    {
        $this->routes[$method][$path] = $action;
        return $this;
    }

    public function get(string $path, callable|array $action): self
    {
        return $this->register('GET', $path, $action);
    }

    public function post(string $path, callable|array $action): self
    {
        return $this->register('POST', $path, $action);
    }

    public function resolve(string $method, string $uri)
    {
        $route = explode('?', $uri)[0];
        $action = $this->routes[$method][$route] ?? null;

        if (! $action) {
            throw new RouteNotFoundException();
        } 

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $userMethod] = $action;

            if (class_exists($class)) {
                $controller = new $class();

                if (method_exists($controller, $userMethod)) {
                    return call_user_func_array([$controller, $userMethod], []);
                }

                throw new MethodNotFoundException();
            }

            throw new ControllerNotFoundException();
        }

        throw new RouteNotFoundException();
    }
}