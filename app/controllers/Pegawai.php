<?php

class Pegawai extends Controller{
    public function __construct()
    {
        $this->middleware(['admin', 'operator']);
    }

    public function index()
    {
        $this->view('layouts/header');
        $this->view('pegawai/index');
        $this->view('layouts/footer');
    }
}