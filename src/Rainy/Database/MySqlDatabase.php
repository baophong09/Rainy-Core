<?php

namespace Rainy\Database;

use \Rainy\Database\Query\MySqlQuery as Query;

class MySqlDatabase extends Database
{
    public function getQuery()
    {
        return new Query($this->pdo);

    public function table($table) {
        return new Query($this->pdo, $table, '');
    }

    public function query($query) {
        $class = new Query($this->pdo, '', '');

        return $class->query($query);

    }
}