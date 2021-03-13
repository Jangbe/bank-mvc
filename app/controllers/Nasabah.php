<?php

class Nasabah extends Controller{
    public function __construct()
    {
        $this->middleware(['nasabah', 'admin', 'operator']);
    }

    public function index()
    {
        $this->view('layouts/header');
        $this->view('nasabah/index');
        $this->view('layouts/footer');
    }
}