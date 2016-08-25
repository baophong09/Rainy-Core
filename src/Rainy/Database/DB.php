<?php

namespace Rainy\Database;

use \Rainy\Helper as Helper;
use \Rainy\Database\Driver as Driver;

// Use Singleton Design Pattern

class DB
{
    /**
     * Store $instance of this class
     * @var Object \Rainy\Database\DB
     */
    public static $instance;

    /**
     * Store connection info of database
     * @var Array
     */
    public static $connection;

    /**
     * Store object Driver
     * @var Object \Rainy\Database\Driver
     */
    public $driver;

    /**
     * Create connection & driver
     *
     * @param Array $connection
     *
     * @return void
     */
    public function __construct($connection){
        self::$connection = $connection;
        $this->driver = new Driver();
    }

    /**
     * Static method to quick call query by table
     *
     * @param String | name of table $table
     *
     * @return static::$instance->connection($connection) will return correct Database Object (ex: \Rainy\Database\MySqlDatabase, \Rany\Database\MsSqlDatabase)
     * @return ->getQuery() will return correct Query Object (ex: \Rainy\Database\MySqlQuery)
     * @return \Rainy\Database\***Query Object with table setted
     */
    public static function table($table)
    {
        static::$instance = static::getInstance();

        $connection = self::$connection;

        return static::$instance->connection($connection)->getQuery()->table($table);
    }

    /**
     * Static method to query directly
     *
     * @param String $query
     *
     * @return
     */
    public static function query($query)
    {
        static::$instance = static::getInstance();
        Helper::debug(static::$instance);
    }

    /**
     * Get Instance, if not Create new, and return
     *
     * @param null
     *
     * @return Object \Rainy\Database\DB
     */
    public static function getInstance()
    {
        if(is_null(static::$instance)) {
            static::$instance = new self(self::$connection);
        }

        return static::$instance;
    }

    /**
     * @param Array $connection
     *
     * @return Object \Rainy\Database\Database (ex: MySql, MsSql)
     */
    public function connection($connection)
    {
        return static::$instance->driver->init($connection);
    }

    /*public static function __callStatic($method, $params)
    {
        return true;
    }*/
}