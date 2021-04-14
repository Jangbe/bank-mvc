<?php

class Operator extends Controller{
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function dashboard()
    {
        $users = count($this->model('UserModel')->getAllUsers());
        $nasabah = count($this->model('NasabahModel')->getAllNasabah());
        $operator = count($this->db->query('SELECT * FROM pegawai')->get());
        $transaksi = count($this->db->query('SELECT * FROM transaksi')->get());
        $this->middleware(['admin', 'operator']);
        $this->view('layouts/header');
        $this->view('pegawai/dashboard', compact('users','nasabah','operator','transaksi'));
        $this->view('layouts/footer');
    }
    
    public function index()
    {
        $this->middleware(['admin']);
        $users = $this->model('UserModel')->getAllUsersPegawai();
        $operator = $this->model('OperatorModel')->getAllOperator();
        $this->view('layouts/header');
        $this->view('pegawai/index', compact('operator', 'users'));
        $this->view('layouts/footer');
    }

    public function show()
    {
        if(!empty($_POST)){
            echo json_encode($this->model('OperatorModel')->getOperator($_POST['id_pegawai']));
        }else{
            abort(403);
        }
    }

    public function create()
    {
        if(!empty($_POST)){
            if($_POST['nm_pegawai'] == '' || 
                $_POST['jk'] == '' || 
                $_POST['no_hp'] == '' || 
                $_POST['email'] == '' ||
                $_POST['alamat'] == ''){
                setFlash('pesan', 'Data Tidak Lengkap', 'danger');
                redirect('operator/nasabah');
            }
            $this->model('OperatorModel')->createOperator($_POST);
        }else{
            abort(403);
        }
    }

    public function update($id)
    {
        if(!empty($_POST)){
            if($_POST['nm_pegawai'] == '' || 
                $_POST['jk'] == '' || 
                $_POST['no_hp'] == '' || 
                $_POST['email'] == '' ||
                $_POST['alamat'] == ''){
                setFlash('pesan', 'Data Tidak Lengkap', 'danger');
                redirect('operator/nasabah');
            }
            $this->model('OperatorModel')->editOperator($_POST, $id);
        }else{
            abort(403);
        }
    }

    public function destroy($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->model('OperatorModel')->destroy($id);
        }else{
            abort(403);
        }
    }

    public function statistic()
    {
        $db = new Database;
        //index ke   0   ,   1   ,    2    ,   3   ,   4    ,    5   ,    6
        $days = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $data['statis'] = [0,0,0,0,0,0,0];
        $day_now = date('w');
        for($i=$day_now;$i>$day_now-7;$i--){
            $a=$i<0?$i+7:$i;
            $day_new[]=$days[$a];
        }
        $data['days']=array_reverse($day_new);
        $transaksi = $db->query("SELECT
                                    DATE_FORMAT(waktu, '%d-%m-%Y') AS tanggal,
                                    DATE_FORMAT(waktu, '%w') AS hari,
                                    COUNT(*) AS jumlah
                                FROM transaksi WHERE waktu > date_sub(now(), interval 1 week) GROUP BY hari ORDER BY waktu")->get();
        foreach($transaksi as $tr){
            foreach($data['days'] as $i => $d){
                if($days[$tr['hari']] == $d){
                    $data['statis'][$i] = intval($tr['jumlah']);
                }
            }
        }
        echo json_encode($data);
    }

    public function statistic_bulan()
    {
        $db = new Database;
        //index ke      1  ,  2  ,   3  ,   4  ,   5  ,   6  ,   7  ,   8  ,   9  ,  10  ,  11  ,  12  
        $months = [1=>'Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data['statis'] = [0,0,0,0,0,0];
        $month_now = date('n');
        $transaksi = $db->query("SELECT
                                    DATE_FORMAT(waktu, '%d-%m-%Y') AS tanggal,
                                    DATE_FORMAT(waktu, '%c') AS bulan,
                                    DATE_FORMAT(waktu, '%b') AS nm_bulan,
                                    COUNT(*) AS jumlah
                                FROM transaksi WHERE waktu > date_sub(now(), interval 6 month) GROUP BY bulan ORDER BY waktu")->get();
        $index = 0;
        for($i=$month_now;$i>$month_now-7;$i--){
            $a=$i<1?$i+12 : $i;
            $month_new[]=$months[$a];
        }
        unset($month_new[count($month_new)-1]);
        foreach($transaksi as $tr){
            foreach($month_new as $i => $mn){
                if($tr['nm_bulan'] == $mn){
                    $data['statis'][$i] = intval($tr['jumlah']);
                }
            }
        }
        $data['month'] = array_reverse($month_new);
        $data['statis'] = array_reverse($data['statis']);
        echo json_encode($data);
    }
}