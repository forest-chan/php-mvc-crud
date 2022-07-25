<?php

namespace app\Core;

class Controller
{

    protected $routeParams;
    protected $model;
    protected $view;

    public function __construct($routeParams)
    {
        $this->routeParams = $routeParams;
        $this->view = new View($routeParams);
        $this->model = $this->loadModel();
    }

    protected function render($title, $content)
    {
        $this->view->render($title, $content);
    }

    protected function redirect($url)
    {
        return header('location: ' . $url);
    }

    private function loadModel()
    {
        $pathToModel =  $_SERVER['DOCUMENT_ROOT'] . '/../' . str_replace('Controller', 'Model', $this->routeParams['controller']) . '.php';
        
        if (!file_exists($pathToModel)) {
        } else {
            $pathToModel = explode('/', trim($pathToModel, '.php'));
            $parts = array_slice($pathToModel, 7);
            $class = implode('\\', $parts);
        
            if (!class_exists($class)) {
            } else {
                return new $class();
            }
        }
    }
}
