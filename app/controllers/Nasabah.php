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
}