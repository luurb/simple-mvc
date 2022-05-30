<?php

use App\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();
include_once __DIR__ . '/../routes/web.php';
$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);