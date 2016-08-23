<?php

namespace Rainy\Database;

use \PDO as PDO;
use \Exception as Exception;

/**
 * Base class for Database
 */
class Database
{
    public $pdo;

    public $db;

    /**
     * Set PDO Connector
     *
     * @param Object $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
}