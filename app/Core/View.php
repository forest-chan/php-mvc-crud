<?php

namespace app\Core;

class View
{
    protected $view;
    protected $routeParams;
    protected $layout = 'default.php';

    public function __construct($routeParams)
    {
        $this->view = implode('/', array_slice(explode('/', str_replace('Controller', 'View', $routeParams['controller'])), 0, -1)) . '/' . $routeParams['action'] . '.php';
        $this->routeParams = $routeParams;
    }

    public function render($title, $content)
    {
        echo $this->renderLayout($title, $this->renderView($content));
    }

    public function setViewPath($path)
    {
        $this->view = $path;
    }

    private function renderLayout($title, $content)
    {
        $pathToLayout = $_SERVER['DOCUMENT_ROOT'] . '/layouts/' . $this->layout;

        if (!file_exists($pathToLayout)) {
        } else {
            ob_start();

            require $pathToLayout;

            return ob_get_clean();
        }
    }

    private function renderView($content)
    {
        $pathToView = $_SERVER['DOCUMENT_ROOT'] . '/../' . $this->view;

        if (!file_exists($pathToView)) {
        } else {
            ob_start();

            extract($content);
            require $pathToView;

            return ob_get_clean();
        }
    }
}
