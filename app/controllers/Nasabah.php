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

    public function statistic()
    {
        $id = $_POST['id_nasabah'];
        $db = new Database;
        //index ke      1  ,  2  ,   3  ,   4  ,   5  ,   6  ,   7  ,   8  ,   9  ,  10  ,  11  ,  12  
        $hari = [];
        $data['statis'] = [];
        for($i=1;$i<=date('t');$i++){
            $hari[] = $i;
            $data['statis'][] = 0;
        }
        $day_now = date('j');
        $bulan = date('m');
        $transaksi = $db->query("SELECT
                                    DATE_FORMAT(waktu, '%d-%m-%Y') AS tanggal,
                                    DATE_FORMAT(waktu, '%e') AS hari,
                                    DATE_FORMAT(waktu, '%c') AS bulan,
                                    COUNT(*) AS jumlah
                                 FROM transaksi
                                    JOIN rekening ON transaksi.no_rekening=rekening.no_rekening
                                    JOIN nasabah ON nasabah.id_nasabah=rekening.id_nasabah
                                 WHERE MONTH(waktu)=$bulan AND nasabah.id_nasabah='$id' GROUP BY hari ORDER BY waktu")->get();
        
        foreach($transaksi as $tr){
            $data['statis'][$tr['hari']-1] = intval($tr['jumlah']);
        }
        $data['days'] = $hari;
        echo json_encode($data);
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