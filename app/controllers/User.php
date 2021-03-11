<?php

class User extends Controller{
    public function index()
    {
        $users = $this->model('UserModel')->getAllUsers();
        var_dump($users);
    }
}