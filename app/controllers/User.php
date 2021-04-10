<?php

class User extends Controller{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $users = $this->model('UserModel')->getAllUsers();
        $level = [
            'admin' => 'Admin',
            'operator' => 'Operator',
            'nasabah' => 'Nasabah'
        ];
        $badge = [
            'admin' => 'danger',
            'operator' => 'primary',
            'nasabah' => 'info'
        ];
        $this->view('layouts/header');
        $this->view('user/index', compact('users', 'level', 'badge'));
        $this->view('layouts/footer');
    }

    public function show()
    {
        if(!empty($_POST)){
            echo json_encode($this->model('UserModel')->getUser($_POST['id_user']));
        }else{
            abort(403);
        }
    }

    public function create()
    {
        if(!empty($_POST)){
            $this->model('UserModel')->createUser($_POST);
        }else{
            abort(403);
        }
    }

    public function update($id)
    {
        if(!empty($_POST)){
            $this->model('UserModel')->editUser($id, $_POST);
        }else{
            abort(403);
        }
    }

    public function destroy(int $id)
    {
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $this->model('UserModel')->destroy($id);
        }else{
            abort(403);
        }
    }
}