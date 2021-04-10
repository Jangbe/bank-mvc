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
        // var_dump($post);die;
        $this->db->query("INSERT INTO nasabah (nm_nasabah, jk, no_hp, email, alamat, id_user) VALUES (:nm_nasabah, :jk, :no_hp, :email, :alamat, :id_user)")
                 ->binds($post)
                 ->execute();
        setFlash('pesan', 'Nasabah berhasil ditambahkan!');
        redirect(user('level').'/nasabah');
    }

    public function getNasabah($id)
    {
        return $this->db->where('id_nasabah', $id)->first();
    }

    public function editNasabah($post, $id)
    {
        // var_dump($post, $id);die;
        unset($post['id_user']);
        $post['id'] = $id;
        $this->db->query("UPDATE nasabah SET nm_nasabah=:nm_nasabah,
                                            jk=:jk,
                                            no_hp=:no_hp,
                                            email=:email,
                                            alamat=:alamat
                                         WHERE id_nasabah=:id")->binds($post)->execute();
                                
        setFlash('pesan', 'Nasabah Berhasil di Edit');
        redirect(user('level').'/nasabah');
    }

    public function destroy($id)
    {
        $this->db->query("DELETE FROM nasabah WHERE id_nasabah=:id")->bind('id', $id)->execute();

        setFlash('pesan', 'Nasabah berhasil dihapus.');
        redirect(user('level').'/nasabah');
    }
}