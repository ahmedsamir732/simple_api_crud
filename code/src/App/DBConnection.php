<?php
namespace APICrud\App;

use Illuminate\Database\Capsule\Manager as Capsule;
// use Illuminate\Events\Dispatcher;
// use Illuminate\Container\Container;

class DBConnection
{
    public function init()
    {
        $capsule = new Capsule;
        $DBConfig = require_once __DIR__.'/../config/DB.php';
        $capsule->addConnection($DBConfig);
        // $capsule->setEventDispatcher(new Dispatcher(new Container));
        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}