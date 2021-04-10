<?php

class Operator extends Controller{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
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