<?php

class RekeningModel{
    private $db;

    public function __construct()
    {
        $this->db = new Database('rekening');
    }

    public function getAllRekening()
    {
        $rekening = $this->db->query("SELECT * FROM rekening
                                      JOIN nasabah ON nasabah.id_nasabah = rekening.id_nasabah
                                      JOIN saldo ON saldo.no_rekening=rekening.no_rekening
                                      JOIN users ON nasabah.id_user=users.id_user")->get();
        return $rekening;
    }

    public function getRekening($norek)
    {
        $rekening = $this->db->query("SELECT * FROM rekening 
                                      JOIN nasabah ON nasabah.id_nasabah = rekening.id_nasabah
                                      WHERE rekening.no_rekening = :norek")
                             ->bind('norek', $norek)->first();
        if(!$rekening) abort();
        return $rekening;
    }

    public function createRekening($post)
    {
        // var_dump($post['norek']);die;
        $this->db->query("INSERT INTO rekening (no_rekening, pin, id_nasabah) VALUES (:norek, :pin, :id_nasabah)")
                 ->bind('norek',$post['norek'])
                 ->bind('pin',$post['pin'])
                 ->bind('id_nasabah',$post['id_nasabah'])
                 ->execute();
        setFlash('pesan', 'Rekening berhasil ditambahkan!');
        redirect(user('level').'/rekening');
    }

    public function editRekening($norek, $post)
    {
        $rekening = $this->db->query("SELECT * FROM rekening WHERE no_rekening = :norek")
                             ->bind('norek', $norek)->first();
        if($rekening['pin'] == $post['pin_old']){
            $this->db->query("UPDATE rekening SET pin=:pin WHERE no_rekening=:norek")
                     ->bind('pin', $post['pin_new'])
                     ->bind('norek', $norek)
                     ->execute();
            setFlash('pesan', 'PIN berhasil diganti.');
            redirect(user('level').'/rekening');
        }else{
            setFlash('pesan', 'PIN salah, PIN gagal diganti.', 'danger');
            redirect(user('level').'/rekening');
        }
    }

    public function destroy($norek)
    {
        $this->db->query("DELETE FROM rekening WHERE no_rekening=:norek")->bind('norek', $norek)->execute();
        setFlash('pesan', 'Rekening berhasil dihapus!');
        redirect(user('level').'/rekening');
    }

}