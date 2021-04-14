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
                $_SESSION['pegawai'] = $this->db->query("SELECT * FROM pegawai WHERE id_user=$user[id_user]")->first();
                header('location: '.BASE_URL.'operator');
                exit;
            }else{
                $_SESSION['nasabah'] = $this->db->query("SELECT * FROM nasabah WHERE id_user=$user[id_user]")->first();
                header('location: '.BASE_URL.'nasabah');
                exit;
            }
        }else{
            setFlash('pesan', 'Username atau Password salah!', 'danger');
            back();
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

    public function edit($post)
    {
        $level = user('level')=='nasabah'?'nasabah':'pegawai';
        $this->db->query("UPDATE users SET username=:user WHERE id_user=:id")->bind('user', $post['username'])->bind('id', user('id_user'))->execute();
        $this->db->query("UPDATE $level SET nm_$level=:nm, no_hp=:no_hp, email=:email, alamat=:alamat WHERE id_$level=:id")
                ->bind('nm', $post['first_name'].' '.$post['last_name'])
                ->bind('no_hp', $post['no_hp'])
                ->bind('email', $post['email'])
                ->bind('alamat', $post['alamat'])
                ->bind('id', level('id'))
                ->execute();
        $_SESSION['user'] = $this->db->query("SELECT * FROM users WHERE id_user=:id")->bind('id', user('id_user'))->first();
        $_SESSION[$level] = $this->db->query("SELECT * FROM $level WHERE id_$level=:id")->bind('id', level('id'))->first();
        setFlash('pesan', 'Profile anda telah diperbarui!');
        back();
    }
    
    public function change($post)
    {
        if(sha1($post['pass_old']) == user('password')){
            $this->db->query("UPDATE users SET password=:pass WHERE id_user=:id")
                     ->bind('pass', sha1($post['pass_new']))->bind('id', user('id_user'))->execute();
            setFlash('pesan', 'Password berhasil diubah!');
        }else if($post['pass_old'] == $post['pass_new']){
            setFlash('pesan', 'Password baru tidak boleh sama dengan sebelumnya!', 'danger');
        }else{
            setFlash('pesan', 'Password tidak cocok!', 'danger');
        }
        back();
    }
}