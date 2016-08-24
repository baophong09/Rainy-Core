<?php

namespace Rainy\Database;

use \Rainy\Database\Query\MySqlQuery as Query;

class MySqlDatabase extends Database
{
<<<<<<< HEAD
    public function getQuery()
    {
        return new Query($this->pdo);
=======
    public function table($table) {
        return new Query($this->pdo, $table, '');
    }

    public function query($query) {
        $class = new Query($this->pdo, '', '');

        return $class->query($query);
>>>>>>> d216d895ce75b35839e3b938b97e2c1832f9804b
    }
}