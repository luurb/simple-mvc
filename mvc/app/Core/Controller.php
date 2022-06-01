<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller 
{
    public function view(string $view, array $options = []): string
    {
        return (new View($view, $options))->render();
    }
}