<?php
require "../vendor/autoload.php";
session_start();
use App\Config\Router;
$router = new Router();
$router->run();