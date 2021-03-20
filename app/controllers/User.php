<?php

class User extends Controller{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $users = $this->model('UserModel')->getAllUsers();
        $this->view('layouts/header');
        $this->view('admin/user', compact('users'));
        $this->view('layouts/footer');
    }

    public function create()
    {
        if(!empty($_POST)){
            $this->model('UserModel')->createUser($_POST);
        }else{
            $level = [
                'admin' => 'Admin',
                'operator' => 'Operator',
                'nasabah' => 'Nasabah'
            ];
            $this->view('layouts/header');
            $this->view('user/create', compact('level'));
            $this->view('layouts/footer');
        }
    }

    public function update(int $id)
    {
        if(!empty($_POST)){
            $this->model('UserModel')->editUser($id, $_POST);
        }else{
            $data = $this->model('UserModel')->getUser($id);
            $pangkat = $data[1];
            $user = $data[0];
            $level = [
                'admin' => 'Admin',
                'operator' => 'Operator',
                'nasabah' => 'Nasabah'
            ];
            $this->view('layouts/header');
            $this->view('user/edit', compact('user', 'pangkat' ,'level'));
            $this->view('layouts/footer');
        }
    }

    public function destroy(int $id)
    {
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $this->model('UserModel')->destroy($id);
        }else{
            redirect('admin/user');
        }
    }
}