<?php

namespace App\Core\Exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = '404 Not Found';
}