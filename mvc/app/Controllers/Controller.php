<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

abstract class Controller 
{
    public function view(string $view, array $options = []): string
    {
        return (new View($view, $options))->render();
    }
}