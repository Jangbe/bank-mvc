<?php

class Admin extends Controller{
    private $db;

    public function __construct()
    {
        $this->middleware(['admin']);
        $this->db = new Database;
    }

    public function index()
    {
        $users = count($this->model('UserModel')->getAllUsers());
        $nasabah = count($this->model('NasabahModel')->getAllNasabah());
        $operator = count($this->db->query('SELECT * FROM pegawai')->get());
        $transaksi = count($this->db->query('SELECT * FROM transaksi')->get());
        $this->view('layouts/header');
        $this->view('admin/index', compact('users', 'nasabah', 'operator', 'transaksi'));
        $this->view('layouts/footer');
    }

    public function generate()
    {
        if(!empty($_POST)){
            $this->model('AdminModel')->generate_pdf($_POST, $this);
        }else{
            redirect('admin');
        }
    }

    public function statistic()
    {
        $db = new Database;
        $days = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $data = [0,0,0,0,0,0,0];
        $transaksi = $db->query("SELECT
                                        DATE_FORMAT(waktu, '%d-%m-%Y') AS tanggal,
                                        DATE_FORMAT(waktu, '%w') AS minggu,
                                        COUNT(*) AS jumlah
                                 FROM transaksi ORDER BY waktu DESC LIMIT 0,7 GROUP BY tanggal")->get();
        foreach($transaksi as $tr){
            $data[$tr['minggu']] = intval($tr['jumlah']);
        }

        echo json_encode($data);
        // var_dump($data);
    }
}