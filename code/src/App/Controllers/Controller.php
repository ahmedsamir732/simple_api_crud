<?php
namespace APICrud\App\Controllers;

use APICrud\App\OutputFormatters\OutputFormatterInterface;

class Controller
{

    protected $outputer;

    public function __construct(OutputFormatterInterface $outputer)
    {
        $this->outputer = $outputer;
    }
}