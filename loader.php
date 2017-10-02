<?php

// common classes to preload as an optimization to bypass autoloader 

$corePreloads = [
    'Slim/src/ResolveCallableTrait',
    'Slim/src/MiddlewareAwareTrait',
    'Slim/src/Slim',
    'Slim/src/Interfaces/CollectionInterface',
    'Slim/src/Collection',
    'Slim/src/Http/Interfaces/EnvironmentInterface',
    'Slim/src/Http/Environment',
    'Slim/src/Http/Interfaces/HeadersInterface',
    'Slim/src/Http/Headers',
    'Slim/src/Http/Interfaces/RequestInterface',
    'Slim/src/Http/Request',
    'Slim/src/Http/Interfaces/ResponseInterface',
    'Slim/src/Http/Response',
    'Slim/src/Routing/Interfaces/RouterInterface',
    'Slim/src/Routing/Router',
    'Slim/src/Routing/Interfaces/RouteInterface',
    'Slim/src/Routing/Route',
    'Slim/src/Routing/Interfaces/RouteInvocationStrategyInterface',
    'Slim/src/Routing/RouteInvocationStrategy',

    'Database/src/DatabaseManager',
    'Database/src/Interfaces/ConnectionInterface',
    'Database/src/Connection',
];

foreach( $corePreloads as $file )
{
	require_once 'src/'.$file.'.php';
}

// class autoloader

function autoloader( $classname )
{
    static $namespaces = [];

    if( is_string($classname) ) // real autoloader
    {
        $classfile = $classname;

        // if don't start with 'App', load in 'src' folder

        if( strpos($classname, 'App\\') === 0 )
        {
            $classfile = lcfirst($classfile); // first letter App/Class -> app/Class
        }
        else
        {
            // replace the leading namespace with the new one ; if any

            foreach( $namespaces as $namespace => $npath )
            {
                if( strpos($classname, $namespace) === 0 ) // start with
                {
                    $classfile = substr_replace($classname, $npath, 0, strlen($namespace));

                    break;
                }
            }

            $classfile = 'src/' . $classfile;
        }

        // set real path

        $classfile = str_replace(['\\', '_'], '/', $classfile); // PSR-0

        $classfile = dirname(__FILE__) . '/' . $classfile . '.php';

        // load class file

        if( file_exists($classfile) )
        {
            require_once $classfile;
        }
        else
        {
            throw new RuntimeException('[loader] "' . $classname . '" called, but "' . $classfile . '" does not exist.');
        }
    }
    elseif( is_array($classname) ) // func declaration
    {
        $namespaces = $classname;

        spl_autoload_register('autoloader');
    }
    else
    {
        throw new RuntimeException('[loader] Class name "' . $classname . '" is unknown.');
    }
}

