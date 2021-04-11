<?php

class Transaksi extends Controller{
    public function index()
    {
        $transaksi = $this->model('TransaksiModel')->getAllTransaksi();
        $sql = "SELECT * FROM rekening 
                JOIN saldo ON rekening.no_rekening=saldo.no_rekening
                JOIN nasabah ON rekening.id_nasabah=nasabah.id_nasabah
                JOIN users ON nasabah.id_user=users.id_user";
        $db = new Database;
        $rekening = $db->query($sql)->get();
        $this->view('layouts/header');
        $this->view('transaksi/index', compact('transaksi','rekening'));
        $this->view('layouts/footer');
    }

    public function detail()
    {
        if(!empty($_POST)){
            $transaksi = $this->model('TransaksiModel')->getTransaksiByIdNasabah($_POST['id']);
            echo json_encode($transaksi);
        }else{
            abort(403);
        }
    }

    public function add()
    {
        if(!empty($_POST)){
            $this->model('TransaksiModel')->addTransaksi($_POST);
        }else{
            abort(403);
        }
    }
}