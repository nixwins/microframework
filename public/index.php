<?php

require_once '../core/autoload.php';
require_once '../core/routes.php';

use Core\Config\AppConfig;
use Core\Routing\Route;
use App\Models\Users;

AppConfig::setDebugFlag(true);
AppConfig::setLogFlag(true);


$route = new Route();

$route->run();


