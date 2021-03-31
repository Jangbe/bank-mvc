<?php

class Transaksi extends Controller{
    public function index()
    {
        $transaksi = $this->model('TransaksiModel')->getAllTransaksi();
        $this->view('layouts/header');
        $this->view('transaksi/index', compact('transaksi'));
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
            $this->view('layouts/header');
            $this->view('transaksi/add');
            $this->view('layouts/footer');
        }
    }
}