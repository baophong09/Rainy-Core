<?php

namespace Rainy\Database;

use \Rainy\Helper as Helper;
use \Rainy\Database\Driver as Driver;

// Use Singleton Design Pattern

class DB
{
    public static $instance;

    protected $testProperty = 'test';

    public static $connection;

    public $driver;  

    public function __construct($connection){
        self::$connection = $connection;
        $this->driver = new Driver();
    }

    public static function table($table)
    {
        static::$instance = static::getInstance();
        
        $connection = self::$connection;

        return static::$instance->connection($connection)->getQuery()->table($table);
    }

    public static function query($query)
    {
        static::$instance = static::getInstance();
        Helper::debug(static::$instance);
    }

    public static function getInstance()
    {
        if(is_null(static::$instance)) {
            static::$instance = new self(self::$connection);
        }

        return static::$instance;
    }

    public function connection($connection)
    {
        return static::$instance->driver->init($connection);
    }

    /*public static function __callStatic($method, $params)
    {
        return true;
    }*/
}