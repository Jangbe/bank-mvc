<?php

class OperatorModel{
    private $db;

    public function __construct()
    {
        $this->db = new Database('operator');
    }

    public function getAllOperator()
    {
        return $this->db->all();
    }
}