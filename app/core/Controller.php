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
    
}

?>