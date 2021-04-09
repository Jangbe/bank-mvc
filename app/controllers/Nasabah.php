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
        
    }

    public function edit($id)
    {

    }
}