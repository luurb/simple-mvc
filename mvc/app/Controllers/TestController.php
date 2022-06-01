<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class TestController extends Controller 
{
    public function index()
    {
        return $this->view('test', ['info' => 'Option test']);
    }
}