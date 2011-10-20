<?php
class Sphincter
{
    protected $_root;
    protected $_query;
    protected $_title;

    public function __construct($root)
    {
        $this->_root  = $root;
        $this->_query = isset($_GET['q']) ? $_GET['q'] : '';
    }

    public function relax()
    {
        header('Content-Type: text/html;charset=UTF-8');
        $body  = $this->_getBody();
        $title = $this->_title;
        require_once __DIR__ . '/layout/layout.phtml';
        ob_end_flush();
    }

    protected function _getRoute()
    {
        $parts = explode('/', $this->_query);
        $route = array(
            'controller' => 'index',
            'action' => 'index',
            'parameters' => array(),
        );
        if (!empty($parts[0])) {
            $first = array_shift($parts);
            $route['action'] = $first;
            if (!empty($parts)) {
                $route['remains'] = $parts;
            }
        }
        
        return $route;
    }

    protected function _getController($route)
    {
        $dir = __DIR__ . "/Controllers";
        $name = ucfirst($route['controller']) . 'Controller';
        if (file_exists("{$dir}/{$name}.php")) {
            require_once "{$dir}/{$name}.php";
            $controller = new $name(__DIR__ . '/layout/views', $route['parameters']);
        } else {
            $controller = null;
        }
        return $controller;
    }

    protected function _getBody()
    {
        $route = $this->_getRoute();
        $controller = $this->_getController($route);
        ob_start();
        if (!is_null($controller)) {
            $method = "{$route['action']}Action";
            $controller->$method($route);
            $this->_title = $controller->getTitle();
        } else {
            header('HTTP/1.1 404 Not Found');
            require_once __DIR__ . '/layout/views/404.phtml';
        }
        return ob_get_clean();
    }
}
?>