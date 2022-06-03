<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Core\Exceptions\ViewNotFoundException;
use App\Core\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function test_throwing_view_not_found_exception(): void
    {
        $view = new View('test');
        $this->expectException(ViewNotFoundException::class);
        $view->render('test');
    }
}