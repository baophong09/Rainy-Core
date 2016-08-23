<?php

namespace Rainy\Database\Query;

use \PDO as PDO;

class Query
{
    protected $pdo;

    protected $stmt;

    protected $query;

    protected $table;

    public function __construct(PDO $pdo, $table) {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    public function execute($query) {
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->execute();

        return $this;
    }

    public function get() {
        if($this->isSelect) {
            $this->selectBuild();

            $this->execute($query);
        }

        return $this->stmt->fetchAll();
    }

    public function query($query) {
        $this->query = '';

        $this->execute($query);

        return $this->stmt->fetchAll();
    }
}