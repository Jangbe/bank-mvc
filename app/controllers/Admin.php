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

    public function nasabah($aksi = 'read', $id = null)
    {
        $this->view('layouts/header');
        switch($aksi){
            case 'create':
                $this->view('nasabah/create');
                break;
            case 'edit':
                if(is_numeric($id)){
                    $nasabah = $this->model('NasabahModel')->getNasabah($id);
                    $this->view('nasabah/edit', compact('nasabah'));
                }else{
                    $this->view('error/404');
                }
                break;
            case 'delete':
                if(is_numeric($id)){
                    $this->model('NasabahModel')->deleteNasabah($id);
                }else{
                    $this->view('error/404');
                }
                break;
            default:
                $this->view('nasabah/index');
        }
        $this->view('layouts/footer');
    }

    public function pegawai()
    {
        if(!empty($_POST)){
            $this->model('NasabahModel');
        }else{
            $this->view('layouts/header');
            $this->view('layouts/footer');
        }
    }

    public function users()
    {
        if(!empty($_POST)){
            $this->model('NasabahModel');
        }else{
            $this->view('layouts/header');
            $this->view('layouts/footer');
        }
    }

    public function rekening()
    {
        if(!empty($_POST)){
            $this->model('NasabahModel');
        }else{
            $this->view('layouts/header');
            $this->view('layouts/footer');
        }
    }
}