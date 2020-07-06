<?php 

namespace HotelFactory\connection;

use Throwable;

class PDOResult implements ResultInterface
{

    protected $statement;
  
    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    public function getArrayResult(): array
    {
        return $this->statement->fetchAll();
    }

    public function getOneOrNullResult(): ?array
    {
        return $this->statement->fetch(); 
    }

    public function getValueResult()
    {
        return $this->statement->fetchColumn();
    }

    public function getResult()
    {
        $result = $this->statement->fetch();
        return $result;
    }
//    public function getOneOrNullResult(string $class = null): ?Model
//    {
//        $result = $this->statement->fetch();
//
//        if($class)
//            return (new $class())->hydrate($result);
//
//        return $result;
//
//
//    }
}