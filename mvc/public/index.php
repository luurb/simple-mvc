<?php

use App\Core\App;
use App\Core\Config;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = App::getInstance();
$app->setConf(new Config($_ENV));
$router = $app->getRouter();
include_once __DIR__ . '/../routes/web.php';
$app->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
