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
        $this->middleware(['admin']);
        if(!empty($_POST)){
            $this->model('AuthModel')->register($_POST);
            header('location: '.BASE_URL.'auth/register');
            exit;
        }else{
            $this->view('auth/register');
        }
    }

    public function profile()
    {
        $nama = explode(' ', level('nama'));
        $nama_awal = $nama[0];
        unset($nama[0]);
        $nama_akhir = implode(' ', $nama);
        $this->view('layouts/header');
        $this->view('user/profile', compact('nama_awal', 'nama_akhir'));
        $this->view('layouts/footer');
    }

    public function edit()
    {
        if(!empty($_POST)){
            if(user('level')!='admin'){

                if($_POST['username'] == '' || 
                $_POST['first_name'] == '' || 
                $_POST['no_hp'] == '' || 
                $_POST['email'] == '' ||
                $_POST['alamat'] == ''){
                    setFlash('pesan', 'Data Tidak Lengkap', 'danger');
                    back();
                }
            }else{
                if($_POST['username']==''){
                    setFlash('pesan', 'Data Tidak Lengkap', 'danger');
                    back();
                }
            }
            $this->model('AuthModel')->edit($_POST);
        }else{
            abort(403);
        }
    }

    public function change()
    {
        if(!empty($_POST)){
            $this->model('AuthModel')->change($_POST);
        }else{
            abort(403);
        }        
    }

    public function logout()
    {
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);

            session_destroy();
            session_unset();
            redirect('auth/login');
        }
        redirect('auth/login');
    }
}
