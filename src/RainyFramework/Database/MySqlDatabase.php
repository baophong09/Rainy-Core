<?php

namespace Rainy\Database;

use \Rainy\Query\MySqlQuery as Query;

class MySqlDatabase extends Database
{
    public static function table($table) {
        return new Query($this->pdo, $table, '');
    }

    public static function query($query) {
        return new Query($this->pdo, '', $query);
    }
}