<?php

class UserModel{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT * FROM users WHERE 1");
        return $this->db->get();
    }
}