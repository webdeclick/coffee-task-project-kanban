<?php

$loader = require 'loader.php';
$config = require 'config.php';

$helpers = require 'helpers.php';
$routes  = require 'routes.php';

autoloader([
    'Slim' => 'Slim/src',
    'Database' => 'Database/src',
]);

use Slim\Slim as SlimApp;
use Database\DatabaseManager;


// session

session_start();

// instantiate the app

$app = new SlimApp($config);

// add middlewares

$app->add(function( $request, $response, $next ) {

    if( !function_exists('DatabaseFactory') )
    {
        function DatabaseFactory( $database = 'default', array $settings = [] )
        {
            return DatabaseManager::factory($database, $settings);
        }
    }

    // create the database manager

    $settings = $this->getSetting('database');

    $dbm = DatabaseFactory('default', $settings);

    return $next($request, $response);
});

// register routes

foreach( $routes as $routeName => $route )
{
    list($method, $uri, $callable) = $route;
    $method = is_array($method) ? $method : [$method];

    $app->map($routeName, $method, $uri, $callable);
}

// set translations

$lang = getPreferedLanguage('fr', $langsAvailable = ['fr','en']);

if( file_exists($langfile = 'languages/'.$lang.'.php') )
{
    putenv('LANG='.$lang.'.utf8');
    setlocale(LC_ALL, $lang.'.utf8');

    __($translations = require $langfile);

    header('Vary: Accept-Language');
}

// run the app, send the response

return $app->run();

