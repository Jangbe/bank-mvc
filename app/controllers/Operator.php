<?php

class Operator extends Controller{
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function dashboard()
    {
        $users = count($this->model('UserModel')->getAllUsers());
        $nasabah = count($this->model('NasabahModel')->getAllNasabah());
        $operator = count($this->db->query('SELECT * FROM pegawai')->get());
        $transaksi = count($this->db->query('SELECT * FROM transaksi')->get());
        $this->middleware(['admin', 'operator']);
        $this->view('layouts/header');
        $this->view('pegawai/dashboard', compact('users','nasabah','operator','transaksi'));
        $this->view('layouts/footer');
    }
    
    public function index()
    {
        $this->middleware(['admin']);
        $users = $this->model('UserModel')->getAllUsersPegawai();
        $operator = $this->model('OperatorModel')->getAllOperator();
        $this->view('layouts/header');
        $this->view('pegawai/index', compact('operator', 'users'));
        $this->view('layouts/footer');
    }

    public function show()
    {
        if(!empty($_POST)){
            echo json_encode($this->model('OperatorModel')->getOperator($_POST['id_pegawai']));
        }else{
            abort(403);
        }
    }

    public function create()
    {
        if(!empty($_POST)){
            if($_POST['nm_pegawai'] == '' || 
                $_POST['jk'] == '' || 
                $_POST['no_hp'] == '' || 
                $_POST['email'] == '' ||
                $_POST['alamat'] == ''){
                setFlash('pesan', 'Data Tidak Lengkap', 'danger');
                redirect('operator/nasabah');
            }
            $this->model('OperatorModel')->createOperator($_POST);
        }else{
            abort(403);
        }
    }

    public function update($id)
    {
        if(!empty($_POST)){
            if($_POST['nm_pegawai'] == '' || 
                $_POST['jk'] == '' || 
                $_POST['no_hp'] == '' || 
                $_POST['email'] == '' ||
                $_POST['alamat'] == ''){
                setFlash('pesan', 'Data Tidak Lengkap', 'danger');
                redirect('operator/nasabah');
            }
            $this->model('OperatorModel')->editOperator($_POST, $id);
        }else{
            abort(403);
        }
    }

    public function destroy($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->model('OperatorModel')->destroy($id);
        }else{
            abort(403);
        }
    }
}