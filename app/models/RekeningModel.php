<?php

class RekeningModel{
    private $db;

    public function __construct()
    {
        $this->db = new Database('rekening');
    }

    public function getAllRekening()
    {
        $rekening = $this->db->query("SELECT * FROM rekening JOIN nasabah ON nasabah.id_nasabah = rekening.id_nasabah")->get();
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
        $this->db->query("INSERT INTO rekening (no_rekening, saldo, pin, id_nasabah) VALUES (:norek, 0, :pin, :id_nasabah)")
                 ->binds($post)
                 ->execute();
        setFlash('pesan', 'Rekening berhasil ditambahkan!');
        redirect('admin/rekening');
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
            redirect('admin/rekening');
        }else{
            setFlash('pesan', 'PIN salah, PIN gagal diganti.', 'danger');
            redirect('admin/rekening/edit/'.$norek);
        }
    }

    public function destroy($norek)
    {
        $this->db->query("DELETE FROM rekening WHERE no_rekening=:norek")->bind('norek', $norek)->execute();
        setFlash('pesan', 'Rekening berhasil dihapus!');
    }

}