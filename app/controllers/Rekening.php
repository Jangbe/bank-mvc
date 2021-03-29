<?php

class Rekening extends Controller{
    public function index()
    {
        $rekening = $this->model('RekeningModel')->getAllRekening();
        $this->view('layouts/header');
        $this->view('admin/rekening', compact('rekening'));
        $this->view('layouts/footer');
    }

    public function create()
    {
        if(!empty($_POST)){
            $this->model('RekeningModel')->createRekening($_POST);
        }else{
            $prefix = substr(time(),-5, 5); //ambil 4 digit depanya
            $suffix = substr(rand(), 0, 7); //ambil 8 digit belakangnta
            $norek = $prefix.$suffix;
            $nasabah = $this->model('NasabahModel')->getAllNasabah();
            $this->view('layouts/header');
            $this->view('rekening/create', compact('norek', 'nasabah'));
            $this->view('layouts/footer');
        }
    }

    public function edit($norek)
    {
        if(!empty($_POST)){
            $this->model('RekeningModel')->editRekening($norek, $_POST);
        }else{
            $rekening = $this->model('RekeningModel')->getRekening($norek);
            $this->view('layouts/header');
            $this->view('rekening/edit', compact('rekening'));
            $this->view('layouts/footer');
        }
    }

    public function destroy($norek)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->model('RekeningModel')->destroy($norek);
        }
        redirect('admin/rekening');
    }
}