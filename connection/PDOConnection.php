<?php

namespace HotelFactory\connection;


class PDOConnection implements BDDInterface
{

    protected $pdo;

    public function __construct()
    {
        $this->connect();
    }

    public function connect() 
    {
        try {
            $this->pdo = new \PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
        } catch (\Throwable $e) {
            die("Erreur SQL : ".$e->getMessage());
        }
    }


    public function query(string $query, array $parameters = null)
    {
        if ($parameters) {
            $queryPrepared = $this->pdo->prepare($query);
            $queryPrepared->execute($parameters);
            return new PDOResult($queryPrepared);
        } else {
            $queryPrepared = $this->pdo->prepare($query);
            $queryPrepared->execute();
            return new PDOResult($queryPrepared);
        }
    }
}