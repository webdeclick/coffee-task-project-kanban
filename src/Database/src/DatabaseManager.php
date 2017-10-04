<?php

namespace Database;

use Database\Interfaces\ConnectionResolverInterface;

use PDO;
use InvalidArgumentException;


class DatabaseManager
{

    /**
     * The active connection instances.
     * @var array
     */
    protected static $connections = [];


    /**
     * Get default application settings
     * 
     * @return array
     */
    protected static function getDefaultSettings()
    {
        return [
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'port'      => '3306',
            'database'  => '',
            'username'  => '',
            'password'  => '',
            'charset'   => 'utf8',
            'prefix'    => '',
            'querylog' => false,
            'options'  => []
        ];
    }

    /**
     * The default PDO connection options.
     *
     * @var array
     */
    public static function getDefaultSettingsOptions()
    {
        return [
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
            PDO::ATTR_STRINGIFY_FETCHES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
    }

    /**
     * Factory : create/get the databse connection
     *
     * @param striong $name
     * @param array $config
     * @return Connection
     */
    public static function factory( $name, array $config = [] )
    {
        if( !isset(static::$connections[$name]) )
        {
            $config = array_replace(static::getDefaultSettings(), $config);

            $options = array_replace(static::getDefaultSettingsOptions(), $config['options']);

            $connector = static::createConnector($config, $options);

            $connection = static::createConnection($connector, $config);

            static::$connections[$name] = $connection;
        }

        return static::$connections[$name];
    }

    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return \PDO
     */
    protected static function createConnector( array $config = [], array $options = [] )
    {
        // brand new connection with PDO options

        $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s', $config['driver'], $config['host'], $config['port'], $config['database'], $config['charset']);

        return ( new PDO($dsn, $config['username'], $config['password'], $options) );
    }

    protected static function createConnection( $connector, array $config = [] )
    {
        return ( new Connection($connector, $config['database'], $config['prefix'], $config['querylog']) );
    }


}
