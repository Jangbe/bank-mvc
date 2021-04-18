<?php

class TransaksiModel{
    private $db, $table = 'transaksi';
    public function __construct()
    {
        $this->db = new Database($this->table);
    }

    public function getAllTransaksi()
    {
        $nasabah = $this->db->query("SELECT * FROM nasabah")->get();
        foreach($nasabah as $i => $nsbh){
            $nasabah[$i]['rekening'] = $this->db->query("SELECT count(*) as jumlah FROM rekening WHERE id_nasabah='$nsbh[id_nasabah]'")->first();
            $nasabah[$i]['transaksi'] = $this->db->query("SELECT count(*) as jumlah FROM transaksi
                                                          JOIN rekening ON transaksi.no_rekening=rekening.no_rekening
                                                          JOIN nasabah ON nasabah.id_nasabah=rekening.id_nasabah
                                                          WHERE nasabah.id_nasabah='$nsbh[id_nasabah]'")->first();
        }
        return $nasabah;
    }

    public function getTransaksiByIdNasabah($id)
    {
        $transaksi = $this->db->query("SELECT * FROM transaksi
                                       JOIN rekening ON transaksi.no_rekening = rekening.no_rekening
                                       JOIN nasabah ON rekening.id_nasabah = nasabah.id_nasabah
                                       WHERE nasabah.id_nasabah=:id ORDER BY id_transaksi DESC")
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
        if($post['norek'] == $post['no_tf']){
            setFlash('pesan', 'No Rekening Yang Dituju tidak boleh sama!', 'danger');
            back();
        }
        $saldo = $this->db->query("SELECT * FROM rekening JOIN saldo ON saldo.no_rekening=rekening.no_rekening WHERE rekening.no_rekening=:norek")->bind('norek', $post['norek'])->first();
        if($post['jns_transaksi'] == 'tarik' || $post['jns_transaksi'] == 'tf'){
            if($saldo['saldo'] < $post['nominal']){
                setFlash('pesan', 'Saldo tidak cukup!', 'danger');
                back();
            }
        }

        if($post['pin'] != $saldo['pin']){
            setFlash('pesan', 'PIN Tidak Cocok!', 'danger');
            back();
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
        back();
    }

    public function getTransfer($post)
    {
        $id_nasabah = level('id');
        $id_transaksi = $post['id_transaksi'];
        return $this->db->query("SELECT nasabah.nm_nasabah as dari,
                                        transfer.no_rekening as kepada,
                                        transfer.jns_pembayaran as jns_pembayaran,
                                        transfer.keterangan as keterangan,
                                        transaksi.waktu as waktu
                                 FROM transfer
                                 JOIN transaksi ON transaksi.id_transaksi=transfer.id_transaksi
                                 JOIN rekening ON transaksi.no_rekening=rekening.no_rekening
                                 JOIN nasabah ON rekening.id_nasabah=nasabah.id_nasabah
                                 WHERE transfer.id_transaksi='$id_transaksi'")->first();
    }
}