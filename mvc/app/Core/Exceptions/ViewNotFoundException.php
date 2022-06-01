<?php

namespace App\Core\Exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'File not found';
}