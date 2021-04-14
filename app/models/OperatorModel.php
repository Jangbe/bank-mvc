<?php

class OperatorModel{
    private $db;

    public function __construct()
    {
        $this->db = new Database('pegawai');
    }

    public function getAllOperator()
    {
        
        return $this->db->all();
    }

    public function getOperator($id)
    {
        return $this->db->where('id_pegawai', $id)->first();
    }

    public function createOperator($post)
    {
        // var_dump($post);die;
        $this->db->query("INSERT INTO pegawai (nm_pegawai, jk, no_hp, email, alamat, id_user) VALUES (:nm_pegawai, :jk, :no_hp, :email, :alamat, :id_user)")
                 ->binds($post)
                 ->execute();
        setFlash('pesan', 'Pegawai berhasil ditambahkan!');
        back();
    }

    public function editOperator($post, $id)
    {
        unset($post['id_user']);
        $post['id'] = $id;
        $this->db->query("UPDATE pegawai SET nm_pegawai=:nm_pegawai,
                                            jk=:jk,
                                            no_hp=:no_hp,
                                            email=:email,
                                            alamat=:alamat
                                         WHERE id_pegawai=:id")->binds($post)->execute();
                                
        setFlash('pesan', 'Pegawai Berhasil di Edit');
        back();
    }

    public function destroy($id)
    {
        $this->db->query("DELETE FROM pegawai WHERE id_pegawai=:id")->bind('id', $id)->execute();

        setFlash('pesan', 'Pegawai berhasil dihapus.');
        back();
    }
}