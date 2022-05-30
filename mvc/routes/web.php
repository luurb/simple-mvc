<?php

use App\Controllers\TestController;

$router->get('/test', [TestController::class, 'index']);