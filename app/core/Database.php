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
    }

    public function execute()
    {
        $this->stmt->execute();
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
    }

    public function first(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}