<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exceptions\ViewNotFoundException;

class View 
{
    public function __construct(private string $view, private array $options = []){}

    public function render(): string
    {
        $viewPath = __DIR__ . '/../../views/' . $this->view . '.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        //Create variables for view
        extract($this->options);

        ob_start();

        include $viewPath;

        return ob_get_clean();
    }
}