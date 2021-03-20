<?php

class AuthModel{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($post)
    {
        $this->db->query("SELECT * FROM users WHERE username=:user AND password=:pass");
        $this->db->bind('user', $post['username']);
        $this->db->bind('pass', sha1($post['password']));
        $user = $this->db->first();
        $_SESSION['user'] = $user;
        if($user){
            if($user['level'] == 'admin'){
                header('location: '.BASE_URL.'admin');
                exit;
            }else if($user['level'] == 'operator'){
                header('location: '.BASE_URL.'operator');
                exit;
            }else{
                header('location: '.BASE_URL.'nasabah');
                exit;
            }
        }else{
            setFlash('pesan', 'Username atau Password salah!', 'danger');
            redirect('auth/login');
        }
    }

    public function register($post)
    {
        $this->db->query("INSERT INTO users (`username`, `password`, `level`) VALUES (:user, :pass, 'nasabah')");
        $this->db->bind('user', $post['username']);
        $this->db->bind('pass', sha1($post['password']));
        $this->db->execute();
        setFlash('pesan', 'User berhasil ditambahkan');
    }
}