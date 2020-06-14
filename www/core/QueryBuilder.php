<?php

namespace HotelFactory\Core; 

class QueryBuilder extends DB
{
    private $query;
    private $where = "";
    private $order = "";
    private $limit = "";
    private $groupBy = "";
    private $selector = "";

    public function __construct()
    {
        parent::__construct();
    }

    public function select($columns)
    {
        $this->selector .= "SELECT ";

        if (is_array($columns)) {
            $lastElement = count($columns);
            $i = 1;
            foreach ($columns as $column) {
                $this->selector .= $column;
                if ($i != $lastElement) {
                    $this->selector .= ", ";
                } else {
                    $this->selector .= " ";
                }
                $i++;
            }
        } else {
            $this->selector .= $columns . " ";
        }
        return $this;
    }

    public function update($table)
    {
        $this->selector .= "UPDATE " . $table . " ";
        return $this;
    }

    public function findAll($table)
    {
        $this->selector = "SELECT *";

        return $this;
    }

    public function count($table)
    {
        $this->selector = "SELECT COUNT(*)";

        return $this;
    }

    public function where($column, $operator, $value = null)
    {
        if (!isset($value)) {
            $value = $operator;
            $operator = "=";
        }
        $this->where .= " " . $column . " " . $operator;
        $this->where .= (is_int($value)) ? " " . $value : " '".$value."'";
        return $this;
    }


    public function like($column, $value = null)
    {
        $this->where .= " " . $column . " LIKE CONCAT('%',:" . $value . ",'%') ";
        return $this;
    }

    public function orderBy($column, $order)
    {
        $this->order .= " " . $column . " " . $order . " ";
        return $this;
    }

    public function groupBy($group)
    {
        $this->groupBy .= " " . $group . " ";
        return $this;
    }

    public function limit($limit)
    {
        $this->limit .= " ".$limit." ";
        return $this;
    }

    public function get()
    {
        if (!isset($this->selector) || !isset($this->table)) {
            return false;
        } else {
            $this->query =
                $this->selector
                . " FROM " . $this->table . " "
                . (!empty($this->where) ? "WHERE" . $this->where : "")
                . (!empty($this->groupBy) ? "GROUP BY" . $this->groupBy : "")
                . (!empty($this->order) ? "ORDER BY" . $this->order : "")
                . (!empty($this->limit) ? "LIMIT" . $this->limit : "");

            $query = $this->pdo->prepare($this->query);
            $query->execute();
            return $query->fetchAll();
        }
    }

    public function save()
    {
        $propChild = get_object_vars($this);
        $propDB = get_class_vars(get_class());

        $columnsData = array_diff_key($propChild, $propDB);
        $columns = array_keys($columnsData);

        if (!is_numeric($this->id)) {

            //INSERT
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", $columns) . ") VALUES (:" . implode(",:", $columns) . ");";
        } else {

            //UPDATE
            foreach ($columns as $column) {
                $sqlUpdate[] = $column . "=:" . $column;
            }

            $sql = "UPDATE " . $this->table . " SET " . implode(",", $sqlUpdate) . " WHERE id=:id;";
        }

        $queryPrepared = $this->pdo->prepare($sql);
        return $queryPrepared->execute($columnsData);
    }

    public function delete($column, $comp, $val = null){
        if (!isset($this->table)) {
            return false;
        } else {
            $this->query =
                "DELETE FROM " . $this->table . " "
                . "WHERE " .
                $column . " " .
                ($val !== null) ? $comp . " " . $val: "= " . $comp ;
            $query = $this->pdo->prepare($this->query);
            return $query->execute();
        }
    }

    public function deleteAll(){
        if(!isset($this->table)){
            return false;
        } else {
            $this->query = "DELETE FROM " . $this->table;
        }
        $query = $this->pdo->prepare($this->query);
        return $query->execute();
    }

    public function getQuery()
    {
        return $this;
    }
}
