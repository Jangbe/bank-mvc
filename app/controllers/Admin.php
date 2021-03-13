<?php

class Admin extends Controller{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $this->view('layouts/header');
        $this->view('admin/index');
        $this->view('layouts/footer');
    }
}