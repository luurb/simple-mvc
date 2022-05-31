<?php

declare(strict_types=1);

namespace App\Controllers;


class TestController extends Controller 
{
    public function index()
    {
        return $this->view('test', ['info' => 'Option test']);
    }
}