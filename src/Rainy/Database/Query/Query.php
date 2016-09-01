<?php

namespace Rainy\Database\Query;

use \PDO as PDO;

class Query
{
    protected $pdo;

    protected $stmt;

    protected $query;

    protected $table;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function paramsBuilder()
    {
        if(isset($this->whereParam)) {
            array_merge($this->params, $this->whereParam);
        }

        if(isset($this->havingParam)) {
            array_merge($this->params, $this->havingParam);
        }

        return true;
    }

    public function beforeExecute($query)
    {
        $this->paramsBuilder();

        $this->prepare($query);

        $this->execute($query);
    }

    public function execute($query)
    {
        $this->stmt->execute($this->params);

        return $this;
    }

    public function get()
    {

        if($this->isSelect) {
            $this->selectBuilder();
            $this->beforeExecute($this->query);
        }

        return $this->fetch();
    }

    public function prepare($query)
    {
        return $this->stmt = $this->pdo->prepare($query);
    }

    public function query($query)
    {
        $this->execute($query);

        $data = $this->fetch();

        return $data;
    }

    public function fetch()
    {
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $this->stmt->fetchAll();
    }
}