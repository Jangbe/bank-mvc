<?php

class About extends Controller{
    public function index(){
        $this->view('about/index');
    }

    public function create()
    {
        echo 'ini class About dengan method create';
    }
}

?>