<?php
require 'vendor/autoload.php';

function dd($vars)
{
    echo '<pre>'.print_r($vars, true);die;
}

$response = new APICrud\App\Response(new APICrud\App\RouteParser, new APICrud\App\OutputFormatters\JsonOutputFormatter);
$response->send();
die;                                                                                                                                                                                                                     