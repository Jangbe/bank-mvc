<?php

class TransaksiModel{
    private $db, $table = 'transaksi';
    public function __construct()
    {
        $this->db = new Database($this->table);
    }

    public function getAllTransaksi()
    {
        $transaksi = $this->db->query("SELECT *, count(*) AS jml FROM transaksi
                                       JOIN rekening ON transaksi.no_rekening = rekening.no_rekening
                                       JOIN nasabah ON rekening.id_nasabah = nasabah.id_nasabah
                                       GROUP BY nasabah.nm_nasabah")->get();
        return $transaksi;
    }

    public function getTransaksiByIdNasabah($id)
    {
        $transaksi = $this->db->query("SELECT * FROM transaksi
                                       JOIN rekening ON transaksi.no_rekening = rekening.no_rekening
                                       JOIN nasabah ON rekening.id_nasabah = nasabah.id_nasabah
                                       WHERE nasabah.id_nasabah=:id")
                                       ->bind('id', $id)->get();
        foreach($transaksi as $k => $v){
            if($v['jns_transaksi'] == 'tf'){
                $transaksi[$k]['jns_transaksi'] = 'Transfer';
            }else{
                $transaksi[$k]['jns_transaksi'] = ucwords($v['jns_transaksi']);
            }
        }
        if(!$transaksi) abort();
        return $transaksi;
    }

    public function addTransaksi($post)
    {
        $saldo = $this->db->query("SELECT * FROM rekening JOIN saldo ON saldo.no_rekening=rekening.no_rekening WHERE rekening.no_rekening=:norek")->bind('norek', $post['norek'])->first();
        if($post['jns_transaksi'] == 'tarik' || $post['jns_transaksi'] == 'tf'){
            if($saldo['saldo'] < $post['nominal']){
                setFlash('pesan', 'Saldo tidak cukup!', 'danger');
                redirect(user('level').'/transaksi');
            }
        }

        if($post['pin'] != $saldo['pin']){
            setFlash('pesan', 'PIN Tidak Cocok!', 'danger');
            redirect(user('level').'/transaksi');
        }

        $this->db->query("INSERT INTO transaksi (waktu, nominal, jns_transaksi, no_rekening)
                          VALUES (:waktu, :nominal, :jns, :norek)")
                 ->bind('waktu', date('Y-m-d H:i:s',time()))
                 ->bind('nominal', $post['nominal'])
                 ->bind('jns', $post['jns_transaksi'])
                 ->bind('norek', $post['norek'])
                 ->execute();
        if($post['jns_transaksi'] == 'tf'){
            $post['id'] = intval($this->db->lastInsertId());
            unset($post['pin']);
            unset($post['nominal']);
            unset($post['norek']);
            unset($post['jns_transaksi']);
            $this->db->query("INSERT INTO `transfer` (jns_pembayaran, keterangan, id_transaksi, no_rekening)
                              VALUES (:jns_pembayaran, :keterangan, :id, :no_tf)")
                     ->binds($post)->execute();
        }

        setFlash('pesan', 'Transaksi berhasil dibuat.');
        redirect(user('level').'/transaksi');
    }
}