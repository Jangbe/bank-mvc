<?php

class Admin extends Controller{
    private $db;

    public function __construct()
    {
        $this->middleware(['admin']);
        $this->db = new Database;
    }

    public function index()
    {
        $users = count($this->model('UserModel')->getAllUsers());
        $nasabah = count($this->model('NasabahModel')->getAllNasabah());
        $operator = count($this->db->query('SELECT * FROM pegawai')->get());
        $transaksi = count($this->db->query('SELECT * FROM transaksi')->get());
        $this->view('layouts/header');
        $this->view('admin/index', compact('users', 'nasabah', 'operator', 'transaksi'));
        $this->view('layouts/footer');
    }

    public function generate()
    {
        if(!empty($_POST)){
            $this->model('AdminModel')->generate_pdf($_POST, $this);
        }else{
            redirect('admin');
        }
    }

}