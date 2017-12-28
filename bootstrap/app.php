<?php


session_start();

require __DIR__.'/../vendor/autoload.php';

// Create and configure Slim app
$config = ['settings' => [
    'displayErrorDetails' => true,
]];


$app = new \Slim\App($config);

$container = $app->getContainer();


$container['db']=function($container){
    $con = new PDO("mysql:dbname=test;host=localhost", 'root' , '' );
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
};

$container['LoginService']=function($container){
    return new \App\Controllers\LoginService($container);
};

$container['TagsService']=function($container){
    return new \App\Controllers\TagsService($container);
};

$container['TelecomeService']=function($container){
    return new \App\Controllers\TelecomeService($container);
};

$container['LteService']=function($container){
    return new \App\Controllers\LteService($container);
};

/*$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard;
};*/

// Register middleware for all routes
// If you are implementing per-route checks you must not add this
//$app->add($container->get('csrf'));