<?php

class Transaksi extends Controller{
    public function index()
    {
        $transaksi = $this->model('TransaksiModel')->getAllTransaksi();
        // var_dump($transaksi);die;
        $rekening = $this->model('RekeningModel')->getAllRekening();
        $this->view('layouts/header');
        $this->view('transaksi/index', compact('transaksi','rekening'));
        $this->view('layouts/footer');
    }

    public function detail()
    {
        if(!empty($_POST)){
            $transaksi = $this->model('TransaksiModel')->getTransaksiByIdNasabah($_POST['id']);
            foreach ($transaksi as $key => $value) {
                $transaksi[$key]['nominal'] = rupiah($value['nominal']);
            }
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