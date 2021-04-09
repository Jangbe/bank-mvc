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

    public function createNasabah($post)
    {
        $this->db->query("INSERT INTO nasabah (nm_nasabah, jk, no_hp, email, alamat, id_user) VALUES (:nm_nasabah, :jk, :no_hp, :email, :alamat, :id_user)")
                 ->binds($post)
                 ->execute();
        setFlash('pesan', 'Nasabah berhasil ditambahkan!');
        redirect('operator/nasabah');
    }
}