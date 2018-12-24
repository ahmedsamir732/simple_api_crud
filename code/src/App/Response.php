<?php
namespace APICrud\App;

use APICrud\App\RouteParser;
use APICrud\App\OutputFormatters\OutputFormatterInterface;
use APICrud\App\DBConnection;

class Response
{
    protected $routeParser;

    protected $outputer;

    protected $error;

    public function __construct(RouteParser $routeParser, OutputFormatterInterface $outputer)
    {
        $this->routeParser = $routeParser;
        $this->outputer = $outputer;
    }

    public function send()
    {
        try {
            $this->startRequestHandlers();
            $this->routeParser->parse();
            $controller = $this->createController();
            // dd($this->routeParser->getVars());
            call_user_func_array(array($controller, $this->routeParser->getMethod()), $this->routeParser->getVars());
            // $controller->{$this->routeParser->getMethod()}($this->routeParser->getVars()); 
        } catch (\Exception  $ex) {
            if (!empty($this->routeParser->error)) {                
                $this->outputer->setOutput($this->routeParser->error['error_code'], ['error' => $this->routeParser->error['message']]);
                return;
            } elseif (!empty($this->error)) {
                $this->outputer->setOutput($this->error['error_code'], ['error' => $this->error['message']]);
                return;
            }
            
            $this->outputer->setOutput(500, ['error' => $ex->getMessage()]);
            return;
        }
    }    

    protected function createController()
    {
        try {
            $controller = "APICrud\App\Controllers\\".$this->routeParser->getController();
            return new $controller($this->outputer);
        } catch (\Exception  $ex) {
            $this->error = [
                'message'  => 'Controller '.$this->routeParser->getController(). 'not found',
                'error_code' => 404
            ];
            throw $ex;
        }
    }

    protected function startRequestHandlers()
    {
        (new DBConnection())->init();
    }
}