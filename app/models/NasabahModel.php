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
        back();
    }

    public function getNasabah($id)
    {
        return $this->db->where('id_nasabah', $id)->first();
    }

    public function editNasabah($post, $id)
    {
        unset($post['id_user']);
        $post['id'] = $id;
        $this->db->query("UPDATE nasabah SET nm_nasabah=:nm_nasabah,
                                            jk=:jk,
                                            no_hp=:no_hp,
                                            email=:email,
                                            alamat=:alamat
                                         WHERE id_nasabah=:id")->binds($post)->execute();
                                
        setFlash('pesan', 'Nasabah Berhasil di Edit');
        back();
    }

    public function destroy($id)
    {
        $this->db->query("DELETE FROM nasabah WHERE id_nasabah=:id")->bind('id', $id)->execute();

        setFlash('pesan', 'Nasabah berhasil dihapus.');
        back();
    }

    public function getTransaksiNasabah()
    {
        $id_user = user('id_user');
        $nasabah = $this->db->query("SELECT * FROM nasabah WHERE id_user='$id_user'")->first();
        return $this->db->query("SELECT * FROM transaksi
                                 JOIN rekening ON transaksi.no_rekening=rekening.no_rekening
                                 JOIN nasabah ON rekening.id_nasabah=nasabah.id_nasabah
                                 WHERE nasabah.id_nasabah='$nasabah[id_nasabah]' ORDER BY transaksi.id_transaksi DESC")->get();
    }
}