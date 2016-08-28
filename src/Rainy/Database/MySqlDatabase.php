<?php

namespace Rainy\Database;

use \Rainy\Database\Query\MySqlQuery as Query;

class MySqlDatabase extends Database
{

    /**
     * get Query of this database
     *
     * @param null
     *
     * @return Object \Rainy\Database\Query
     */
    public function getQuery()
    {
        return new Query($this->pdo);
    }
}