<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;


abstract class AbstractController {

    protected $container = [];


    /**
     * Constructor
     *
     * @param array $container
     */
    public function __construct( array $container = [] )
    {
        $this->container = $container;

        $isLogged = false;

        if( session('isLogged') )
        {
            $isLogged = true;

            $this->userId = session('userId');
        }

        $this->isLogged = $isLogged;
    }



    ////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Dynamically get container attributes
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get( $key )
    {
        return ( isset($this->container[$key]) ? $this->container[$key] : null );
    }

    /**
     * Dynamically set container attributes
     *
     * @param  string  $key
     * @param  mixed   $value
     */
    public function __set( $key, $value )
    {
        //exceptions
        // if( in_array($key, ['errors']) )
        // {
        //     $this->container[$key][] = $value;
        // }

        $this->container[$key] = $value;
    }

    /**
     * Determine if a container attribute exists
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset( $key )
    {
        return isset($this->container[$key]);
    }

    /**
     * Unset a container attribute
     *
     * @param  string  $key
     * @return void
     */
    public function __unset( $key )
    {
        unset($this->container[$key]);
    }


}
