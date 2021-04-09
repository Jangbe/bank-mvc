<?php

class Nasabah extends Controller{
    public function __construct()
    {
        $this->middleware(['admin', 'operator', 'nasabah']);
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
}