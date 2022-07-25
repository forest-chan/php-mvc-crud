<?php

namespace app\Core;

class Router
{
    private $routes;
    private $routeParams;
    private $correctRoutes;

    public function __construct($routes)
    {
        $this->routes = $routes;
        foreach ($this->routes as $route => $routeParams) {
            $this->addRoute($route, $routeParams);
        }
    }

    public function startRoute()
    {
        $uri = parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);


        if (!$this->matchRoute($uri)) {
            require $_SERVER['DOCUMENT_ROOT'] . '/views/errors/404.php';
            die;
        } else {
            $pathToController = $_SERVER['DOCUMENT_ROOT'] . '/../' . $this->routeParams['controller'] . '.php';


            if (!file_exists($pathToController)) {
            } else {


                $pathToController = explode('/', trim($pathToController, '.php'));
                $parts = array_slice($pathToController, 7);
                $class = implode('\\', $parts);


                if (!class_exists($class)) {
                } else {

                    $action = $this->routeParams['action'];
                    $controller = new $class($this->routeParams);
                    $controller->$action();
                }
            }
        }
    }

    private function addRoute($route, $routeParams)
    {
        $route = '~^' . $route . '$~';
        $this->correctRoutes[$route] = $routeParams;
    }

    private function matchRoute($uri)
    {
        $matches = [];
        foreach ($this->correctRoutes as $route => $routeParams) {
            if (preg_match($route, $uri, $matches)) {
                if(isset($matches[1]) && is_numeric($matches[1])){
                    $routeParams['id'] = $matches[1];
                }
                $this->routeParams = $routeParams;
                $this->routeParams['requestMethod'] = $_SERVER['REQUEST_METHOD'];
                return true;
            }
        }
        return false;
    }
}
