<?php

class controller{
    public function view($file, $data = []){
        require '../app/views/'.$file.'.php';
    }

    public function model($model)
    {
        require '../app/models/'.$model.'.php';
        return new $model;
    }

    public function middleware($level = []){
        if(isset($_SESSION['user'])){
            if(!in_array($_SESSION['user']['level'], $level)){
                $this->view('error/403');
                exit;
            }
        }else{
            header('location: '.BASE_URL.'auth/login');
        }
    }
    
}

?>