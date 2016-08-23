<?php

namespace Rainy\Database\Connectors;

use \PDO as PDO;
use \Exception as Exception;

/**
 * Base class for connector
 */

class Connector
{
    protected $options = [];

    /**
     * Create PDO Connection
     *
     * @param Array $config
     * @param Array $options
     *
     * @return callback $this->PDOConnect
     */
    public function createConnection($config, $options = [])
    {
        if(isset($config["dsn"]) && isset($config["username"]) && isset($config["password"])) {
            return $this->PDOConnect($config["dsn"], $config["username"], $config["password"], $options);
        }

        throw new Exception("Connection configs are missing !");
    }

    /**
     * Connect to Database use PDO
     *
     * @param String $dsn
     * @param String $username
     * @param String $password
     * @param Array $options
     *
     * @return \PDO Object
     */
    public function PDOConnect($dsn, $username, $password, $options)
    {
        return new PDO($dsn, $username, $password, $options);
    }

    /**
     * Set option
     *
     * @param Array $options
     *
     * @return Array
     */
    public function setOptions($options)
    {
        return $this->options = $options;
    }
}

