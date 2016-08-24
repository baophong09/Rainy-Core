<?php

namespace Rainy\Database;

use \Rainy\Database\Query\MySqlQuery as Query;

class MySqlDatabase extends Database
{
    public function getQuery()
    {
        return new Query($this->pdo);
    }
}