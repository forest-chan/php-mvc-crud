<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'] . '/../' . $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

$routes = require $_SERVER['DOCUMENT_ROOT'] . '/../app/Config/routes.php';

$router = new app\Core\Router($routes);
$router->startRoute();
