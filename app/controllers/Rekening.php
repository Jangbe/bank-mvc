<?php

class Rekening extends Controller{
    public function index()
    {
        $nasabah = $this->model('NasabahModel')->getAllNasabah();
        $rekening = $this->model('RekeningModel')->getAllRekening();
        $prefix = substr(time(),-3, 3); //ambil 4 digit depanya
        $suffix = substr(rand(), 0, 6); //ambil 8 digit belakangnta
        $norek = '1'.$prefix.$suffix;
        $this->view('layouts/header');
        $this->view('rekening/index', compact('rekening', 'norek', 'nasabah'));
        $this->view('layouts/footer');
    }

    public function show()
    {
        if(!empty($_POST)){
            echo json_encode($this->model('RekeningModel')->getRekening($_POST['norek']));
        }else{
            abort(403);
        }
    }

    public function create()
    {
        if(!empty($_POST)){
            $this->model('RekeningModel')->createRekening($_POST);
        }else{
            abort(403);
        }
    }

    public function edit($norek)
    {
        if(!empty($_POST)){
            $this->model('RekeningModel')->editRekening($norek, $_POST);
        }else{
            abort(403);
        }
    }

    public function destroy($norek)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->model('RekeningModel')->destroy($norek);
        }
        abort(403);
    }
}