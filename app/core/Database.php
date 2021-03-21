<?php

class Database{
    private $dbh,
            $table,
            $stmt,
            $host = DB_HOST,
            $user = DB_USER,
            $pass = DB_PASS,
            $db = DB_NAME;


    public function __construct($table = null)
    {
        $this->table = $table;
        $dsn = "mysql:host=$this->host; dbname=$this->db";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }catch(PDOException $e){
            echo $e->getMessage();
            die;
        }
    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
        return $this;
    }

    public function execute()
    {
        $this->stmt->execute();
        return $this;
    }

    public function bind($key, $value, $type = null)
    {
        if(is_null($type)){
            switch(true){
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_numeric($value):
                    $type = PDO::PARAM_INT;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($key, $value, $type);
        return $this;
    }

    public function binds(Array $value)
    {
        foreach($value as $k => $v){
            $this->bind($k, $v);
        }
        return $this;
    }

    public function where($column, $where)
    {
        if(!empty($this->table)){
            if(is_array($column)){
                foreach($column as $k => $v){
                    $row[] = $k.' = :'.$k;
                    $this->bind($k, $v);
                }
                $row = implode(' AND ', $row);
                $this->stmt = $this->query("SELECT * FROM ".$this->table." WHERE $row");
            }else{
                $key = ':'.$column;
                $this->query("SELECT * FROM $this->table WHERE `$column`=:$column")->bind($column, $where);
            }
            return $this;
        }
        return false;
    }

    public function all()
    {
        if(!empty($this->table)){
            $this->stmt = $this->dbh->prepare("SELECT * FROM ".$this->table);
            return $this->get();
        }
        return false;
    }

    public function first(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}