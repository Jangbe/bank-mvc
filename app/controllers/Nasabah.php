<?php

class Nasabah extends Controller{
    private $db;

    public function __construct()
    {
        $this->middleware(['admin', 'operator', 'nasabah']);
        $this->db = new Database;
    }

    public function dashboard()
    {
        $rekening = $this->db->query("SELECT * FROM rekening 
                                      JOIN saldo ON rekening.no_rekening=saldo.no_rekening
                                      JOIN nasabah ON rekening.id_nasabah=nasabah.id_nasabah
                                      JOIN users ON nasabah.id_user=users.id_user
                                      WHERE users.id_user=:id")->bind('id', user('id_user'))->get();
        $total_saldo = 0;
        foreach($rekening as $rek){
            $total_saldo += $rek['saldo'];
        }

        $this->view('layouts/header');
        $this->view('nasabah/dashboard', compact('rekening', 'total_saldo'));
        $this->view('layouts/footer');
    }

    public function index()
    {
        if(!empty($_POST)){
            $this->model('NasabahModel')->createNasabah($_POST);
        }else{
            $nasabah = $this->model('NasabahModel')->getAllNasabah();
            $users = $this->model('UserModel')->getAllUsersNasabah();
            $this->view('layouts/header');
            $this->view('nasabah/index', compact('nasabah','users'));
            $this->view('layouts/footer');
        }
    }

    public function create()
    {
        if(!empty($_POST)){
            if($_POST['nm_nasabah'] == '' || 
                $_POST['jk'] == '' || 
                $_POST['no_hp'] == '' || 
                $_POST['email'] == '' ||
                $_POST['alamat'] == ''){
                setFlash('pesan', 'Data Tidak Lengkap', 'danger');
                redirect('operator/nasabah');
            }
            $this->model('NasabahModel')->createNasabah($_POST);
        }else{
            abort(403);
        }
    }

    public function update($id)
    {
        if(!empty($_POST)){
            if($_POST['nm_nasabah'] == '' || 
                $_POST['jk'] == '' || 
                $_POST['no_hp'] == '' || 
                $_POST['email'] == '' ||
                $_POST['alamat'] == ''){
                setFlash('pesan', 'Data Tidak Lengkap', 'danger');
                redirect('operator/nasabah');
            }
            $this->model('NasabahModel')->editNasabah($_POST, $id);
        }else{
            abort(403);
        }
    }

    public function show()
    {
        if(!empty($_POST)){
            echo json_encode($this->model('NasabahModel')->getNasabah($_POST['id_nasabah']));
        }else{
            abort(403);
        }
    }

    public function destroy($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->model('NasabahModel')->destroy($id);
        }else{
            abort(403);
        }
    }

    public function transfer()
    {
        if(!empty($_POST)){
            $_POST['jns_transaksi'] = 'tf';
            $this->model('TransaksiModel')->addTransaksi($_POST);
        }else{
            $transaksi = $this->model('NasabahModel')->getTransaksiNasabah();
            $sql = "SELECT * FROM rekening 
                    JOIN saldo ON rekening.no_rekening=saldo.no_rekening
                    JOIN nasabah ON rekening.id_nasabah=nasabah.id_nasabah
                    JOIN users ON nasabah.id_user=users.id_user";
            $rekening = $this->db->query($sql." WHERE users.id_user=:id")->bind('id', user('id_user'))->get();
            $rekening_transfer = $this->db->query($sql." WHERE users.id_user!=:id")->bind('id', user('id_user'))->get();
            $this->view('layouts/header');
            $this->view('nasabah/transfer', compact('transaksi','rekening','rekening_transfer'));
            $this->view('layouts/footer');
        }
    }
}