<?php

class Nasabah extends Controller{
    public function __construct()
    {
        $this->middleware(['admin', 'operator', 'nasabah']);
    }

    public function index()
    {
        $this->view('layouts/header');
        $this->view('nasabah/index');
        $this->view('layouts/footer');
    }

    public function create()
    {
        echo 'ini class nasabah dengan method create';
    }

    public function edit($id)
    {
        echo 'Hi, id nya adalah '.$id;
    }
}