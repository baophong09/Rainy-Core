<?php

namespace Rainy\Database\Query;

class MySqlQuery extends Query
{
    protected $select;

    protected $where;

    protected $join;

    protected $having;

    protected $or;

    protected $insert;

    protected $update;

    protected $limit;

    protected $isSelect;

    protected $isDelete;

    protected $isUpdate;

    protected $isInsert;

    protected $whereParam;

    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    public function select($columns = ['*'], $alias = '')
    {
        if(is_array($columns)) {
            $this->selectByArray($columns);
        } 

        if(is_string($columns)) {
            $this->selectByString($columns);
        }

        if(isset($alias) && $alias && is_string($alias)) {
            $this->selectAs($alias);
        }

        $this->isSelect = true;

        return $this;
    }

    public function selectByArray($columns)
    {
        return $this->select = $this->selectByString(implode(",", $columns));
    }

    public function selectByString($columns)
    {
        return $this->select = "SELECT ".$columns;
    }

    public function selectAs($alias)
    {
        return $this->select .= "AS ".$alias;
    }

    public function where($column, $operator = '', $value = '')
    {
        if($operator && $value) {
            $this->whereByParams($column, $operator, $value);
        } else {
            $this->whereByString($column);
        }

        return $this;
    }

    public function whereByParams($column, $operator, $value)
    {
        $this->where .= " AND ".$column." ".$operator." ? ";
        return $this->whereParam[] = $value;
    }

    public function whereByString($query)
    {
        $params = explode(' ', $query);
        return $this->where .= ' AND '.$query;
    }

    public function limit($limit,$offset = 0)
    {
        $this->limit = $offset.",".$limit;

        return $this;
    }

    public function selectBuilder() {
        $this->query = '';

        $this->query .= ($this->select)?: '';

        $this->query .= ($this->table) ? ' FROM '.$this->table : '';

        $this->query .= ($this->table) ? ' WHERE 1'.$this->where : '';

        $this->query .= ($this->limit) ? ' LIMIT '.$this->limit : '';
    }
}