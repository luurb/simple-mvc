<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller 
{
    const VIEWS_PATH = __DIR__ . '/../../views';

    public function view(string $view, array $options = []): string
    {
        return (new View($view, $options))->render(self::VIEWS_PATH);
    }
}