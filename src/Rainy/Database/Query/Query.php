<?php

namespace Rainy\Database\Query;

use \PDO as PDO;

class Query
{
    protected $pdo;

    protected $stmt;

    protected $query;

    protected $table;

    public function __construct(PDO $pdo, $table, $query) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->query = $query;

        if($this->query) {
            $this->query($this->query);
        }
    }

    public function execute($query) {
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->execute();

        return $this;
    }

    public function get() {
        if($this->isSelect) {
            $this->selectBuilder();

            $this->execute($this->query);
        }

        return $this->fetch();
    }

    public function query($query) {
        $this->execute($query);

        $data = $this->fetch();

        return $data;
    }

    public function fetch() {
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $this->stmt->fetchAll();
    }
}