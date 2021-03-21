<?php


class NasabahModel{
    private $db;

    public function __construct()
    {
        $this->db = new Database('nasabah');
    }

    public function getAllNasabah()
    {
        return $this->db->all();
    }
}