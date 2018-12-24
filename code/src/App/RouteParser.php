<?php
namespace APICrud\App;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;

class RouteParser 
{
    protected $controller;

    protected $method = 'index';

    protected $vars = [];

    public $error;

    public function parse()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function(RouteCollector $r) {
            require __DIR__.'/../routes/api.php';    
        });
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];        
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                $this->error = ['error_code' => 404, 'message' => 'The route you have specified is not found.'];
                throw new \Exception("The route you have specified is not found.", 1);                
                break;
                case Dispatcher::METHOD_NOT_ALLOWED:
                // ... 405 Method Not Allowed
                $this->error = ['error_code' => 405, 'message' => 'The method you want is not allowed..'];
                throw new \Exception("The method you want is not allowed..", 1);                
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $this->vars = $routeInfo[2];
                $info = explode('@', $handler);
                $this->controller = $info[0]??null;
                if (!empty($info[1])) {
                    $this->method = $info[1];                
                }
                break;
        }
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getVars(): array
    {
        return $this->vars;
    }
}