<?php

namespace Rainy\Database\Query;

use \Exception as Exception;

class MySqlQuery extends Query
{
    /**
     * Store select query
     *
     * @var String select
     */
    protected $select;

    /**
     * Store where query
     *
     * @var String where
     */
    protected $where;

    /**
     * Store join query
     *
     * @var String join
     */
    protected $join;

    /**
     * Store having query
     *
     * @var String having
     */
    protected $having;

    /**
     * Store or query
     *
     * @var String or
     */
    protected $or;

    protected $insert;

    protected $update;

    protected $limit;

    protected $isSelect;

    protected $isDelete;

    protected $isUpdate;

    protected $isInsert;

    protected $whereParam;

    protected $havingParam;

    protected $params;

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
        $this->whereParam[] = $value;

        return true;
    }

    public function whereByString($query)
    {
        $params = explode(' ', $query);

        if(count($params) != 3) {
            throw new Exception("where require space to split column, operator and value");
        }

        $this->where .= ' AND '.$params[0].' '.$params[1].' ? ';
        $this->whereParam[] = $params[2];

        return true;
    }

    public function limit($limit,$offset = 0)
    {
        $this->limit = ' LIMIT '.$offset.",".$limit;

        return $this;
    }

    public function join($type = 'INNER JOIN', $table, $columnOne, $operator, $columnTwo, $alias = '')
    {
        $this->join .= ' '.$type.' '.$table;

        if($alias) {
            $this->join .= ' as '.$alias;
        }

        $this->join .= ' ON '.$columnOne.' '.$operator.' '.$columnTwo;
    }

    public function innerJoin($table, $columnOne, $operator, $columnTwo, $alias = '')
    {
        $this->join('INNER JOIN', $table, $columnOne, $operator, $columnTwo, $alias);

        return $this;
    }

    public function leftJoin($table, $columnOne, $operator, $columnTwo, $alias = '')
    {
        $this->join('LEFT JOIN', $table, $columnOne, $operator, $columnTwo, $alias);

        return $this;
    }

    public function having($column, $operator, $value)
    {
        $this->having = ' HAVING '.$column.' '.$operator.' ? ';
        $this->havingParam[] = $value;
    }

    public function selectBuilder() {
        $this->query = '';

        $this->query .= ($this->select)?: '';

        $this->query .= ($this->table) ? ' FROM '.$this->table : '';

        $this->query .= ($this->join) ? $this->join : '';

        $this->query .= ($this->where) ? ' WHERE 1'.$this->where : '';

        $this->query .= ($this->limit) ? $this->limit : '';
    }
}