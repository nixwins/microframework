<?php

require_once '../core/autoload.php';
require_once '../core/routes.php';

use Core\Config\AppConfig;
use Core\Http\Route;

AppConfig::setDebugFlag(true);
AppConfig::setLogFlag(true);

$route = new Route();

echo "<pre>";
$route->run();
echo "</pre>";
