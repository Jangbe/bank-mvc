<?php

class Home extends Controller{

    public function index()
    {
        $this->view('page/index');
    }

    public function show()
    {
        echo 'ini controller home dengan method show';
    }

    public function nama($nama, $umur){
        echo 'Hallo nama saya '.$nama.', umur saya '.$umur.' tahun';
    }

}