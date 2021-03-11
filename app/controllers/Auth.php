<?php

class Auth extends Controller{
    public function login()
    {
        if(!empty($_POST)){
            $this->model('AuthModel')->login($_POST);
        }else{
            $this->view('auth/login');
        }
    }

    public function register()
    {
        if(!empty($_POST)){
            $this->model('AuthModel')->register($_POST);
            header('location: '.BASE_URL.'auth/register');
            exit;
        }else{
            $this->view('auth/register');
        }
    }
}