<?php

class UserModel{
    private $db;
    private $table = 'users';

    public function __construct()
    {
        $this->db = new Database($this->table);
    }

    public function getAllUsers()
    {
        return $this->db->all();
    }

    public function getAllUsersNasabah()
    {
        return $this->db->query('SELECT * FROM users WHERE level = "nasabah" ')->get();
    }

    public function getUser($id)
    {
        $user = $this->db->where('id_user', $id)->first();
        if($user['level'] == 'operator'){
            $table = 'pegawai';
        }else if($user['level'] == 'nasabah'){
            $table = 'nasabah';
        }
        $pangkat = isset($table) ? $this->db->query("SELECT * FROM $table WHERE id_user=:id")
            ->bind('id', $id)->first() : [];
        if(!$user) abort();
        return [$user, $pangkat];
    }

    public function createUser($post)
    {
        $this->db->query("INSERT INTO $this->table (username, password, level) VALUES (:user, :pass, :lev)")
                 ->bind('user', $post['username'])
                 ->bind('pass', sha1($post['password']))
                 ->bind('lev', $post['level'])->execute();
        $last_id = intval($this->db->lastInsertId());
        if($post['level'] != 'admin'){
            $table = $post['level'] == 'nasabah'? 'nasabah' : 'pegawai';
            $sql = "INSERT INTO $table (nm_$table, jk, no_hp, email, alamat, id_user) VALUES (:nm, :jk, :no_hp, :email, :alamat, :id)";
            $this->db->query($sql)
                     ->bind('nm', $post['nm'])
                     ->bind('jk', $post['jk'])
                     ->bind('no_hp', $post['no_hp'])
                     ->bind('email', $post['email'])
                     ->bind('alamat', $post['alamat'])
                     ->bind('id', $last_id)
                     ->execute();
        }

        setFlash('pesan', 'User berhasil dibuat');
        redirect('admin/user');
    }

    public function editUser($id, $post)
    {
        $user = $this->getUser($id);
        $pass = empty($post['password']) ? $user[0]['password'] : sha1($post['password']);
        $this->db->query("UPDATE users SET username=:user, password=:pass, level=:level WHERE id_user=:id")
            ->bind('id', $id)
            ->bind('user', $post['username'])
            ->bind('pass', $pass)
            ->bind('level', $post['level'])
            ->execute();
        if($user[0]['level'] != 'admin' && $post['level'] == 'admin'){
            $this->db->query("DELETE FROM pegawai WHERE id_user=:id")->bind('id', $id)->execute();
            $this->db->query("DELETE FROM nasabah WHERE id_user=:id")->bind('id', $id)->execute();
        }else{
            if($post['level'] != 'admin'){
                $table = $post['level'] == 'nasabah' ? 'nasabah' : 'pegawai';
                $oldTingkat = $user[0]['level'] == 'nasabah' ? 'nasabah' : 'pegawai';
                $tingkat = $this->db->query("SELECT * FROM $oldTingkat WHERE id_user=:id")->bind('id', $id)->first();
                if($tingkat){
                    if($oldTingkat != $table){
                        $this->db->query("DELETE FROM $oldTingkat WHERE id_user=:id")->bind('id', $id)->execute();
                        $this->db->query("INSERT INTO $table SET nm_$table=:nama, jk=:jk, no_hp=:no_hp, email=:email, alamat=:alamat, id_user=:id")
                                          ->bind('nama', $post['nm'])
                                          ->bind('jk', $post['jk'])
                                          ->bind('no_hp', $post['no_hp'])
                                          ->bind('email', $post['email'])
                                          ->bind('alamat', $post['alamat'])
                                          ->bind('id', $id)
                                          ->execute();
                    }else{
                        $this->db->query("UPDATE $table SET nm_$table=:nama, jk=:jk, no_hp=:no_hp, email=:email, alamat=:alamat WHERE id_user=:id")
                                          ->bind('nama', $post['nm'])
                                          ->bind('jk', $post['jk'])
                                          ->bind('no_hp', $post['no_hp'])
                                          ->bind('email', $post['email'])
                                          ->bind('alamat', $post['alamat'])
                                          ->bind('id', $id)
                                          ->execute();
                    }
                }else{
                    $this->db->query("INSERT INTO $table (nm_$table, jk, no_hp, email, alamat, id_user)
                                      VALUES (:nama, :jk, :no_hp, :email, :alamat, :id)")
                                      ->bind('nama', $post['nm'])
                                      ->bind('jk', $post['jk'])
                                      ->bind('no_hp', $post['no_hp'])
                                      ->bind('email', $post['email'])
                                      ->bind('alamat', $post['alamat'])
                                      ->bind('id', $id)
                                      ->execute();
                }
            }
        }

        setFlash('pesan', 'User berhasil diedit.');
        redirect('admin/user');
    }

    public function destroy($id)
    {
        $this->db->query("DELETE FROM users WHERE id_user=:id")->bind('id', $id)->execute();   
        $this->db->query("DELETE FROM pegawai WHERE id_user=:id")->bind('id', $id)->execute();
        $this->db->query("DELETE FROM nasabah WHERE id_user=:id")->bind('id', $id)->execute();

        setFlash('pesan', 'User berhasil dihapus.');
        redirect('admin/user');
    }
}