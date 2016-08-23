<?php

namespace Rainy\Database\Connectors;

use \Rainy\Database\Connectors\ConnectorInterface as ConnectorInterface;
use \Rainy\Database\Connectors\Connector as Connector;

/**
 * MySqlConnector is connector adapter for MySQL Database
 */

class MySqlConnector extends Connector implements ConnectorInterface
{
    /**
     * Connect to database
     *
     * @param Array $config
     *
     * @return \PDO Object
     */
    public function connect($config) {
        $config["dsn"] = $this->getDsn($config);

        // create object PDO
        $connection = $this->createConnection($config, $this->options);

        // use database
        if(isset($config["database"]) && $config["database"]) {
            $connection->exec("use `".$config['database']."`;");
        }

        // set charset
        if(isset($config['charset'])) {
            $query = "set names '{$charset}'" . ($config['collation']) ? " collate '{$config['collation']}'" : '';

            $connection->prepare($query)->execute();
        }

        // return Object PDO
        return $connection;
    }

    /**
     * Get DSN for MySQL
     *
     * @param Array $config
     *
     * @return String
     */
    public function getDsn($config) {
        return isset($config['port'])
                        ? "mysql:host=".$config['host'].";port=".$config['port'].";dbname=".$config["database"] 
                        : "mysql:host=".$config['host'].";dbname=".$config["database"];
    }
}