<?php

require_once './vendor/autoload.php';

use Router\Router;

session_start();

$router = new Router();
$router->routeMap();