<?php

use Mpdf\Mpdf;

class AdminModel{
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    public function generate_pdf($post, $instance)
    {
        $mpdf = new Mpdf;
        ob_start();
        $is_all = isset($post['all']);
        if(!$is_all){
            $dates = explode(' - ', $post['dates']);
            $dates[0] = date('Y-m-d',strtotime($dates[0]));
            $dates[1] = date('Y-m-d',strtotime($dates[1]));
        }

        $query = "SELECT * FROM transaksi JOIN rekening ON transaksi.no_rekening=rekening.no_rekening 
                                          JOIN nasabah ON rekening.id_nasabah=nasabah.id_nasabah ";
        if($is_all){
            if(isset($post['id_nasabah'])){
                $query .= " WHERE nasabah.id_nasabah=:id_nasabah";
            }
            $data['transaksi'] = $this->db->query($query);
        }else{
            if($dates[0]==$dates[1]){
                $query .= "WHERE DATE(waktu)=:awal";
                if(isset($post['id_nasabah'])){
                    $query .= " AND nasabah.id_nasabah=:id_nasabah";
                }
                $data['transaksi'] = $this->db->query($query);
            }else{
                $query .= "WHERE waktu BETWEEN :awal AND :akhir";
                if(isset($post['id_nasabah'])){
                    $query .= " AND nasabah.id_nasabah=:id_nasabah";
                }
                $data['transaksi'] = $this->db->query($query)
                                    ->bind('akhir', $dates[1]);
            }
        }
        if(isset($post['id_nasabah'])){
            $data['transaksi'] = $data['transaksi']->bind('id_nasabah', $post['id_nasabah']);
        }
        if($is_all){
            $data['transaksi'] = $data['transaksi']->get();
        }else{
            $data['transaksi'] = $data['transaksi']->bind('awal', $dates[0])->get();
        }
        if(isset($post['id_nasabah'])){
            $data['nasabah'] = $this->db->query("SELECT * FROM nasabah 
                                                 WHERE id_nasabah=:id_nasabah")
                                        ->bind('id_nasabah', $post['id_nasabah'])->first();
        }
        $instance->view('admin/pdf', $data);
        $html = ob_get_contents();
        ob_end_clean();
        
        $stylesheet = file_get_contents(__DIR__.'/../../public/assets/css/argon.css');

        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html, 0);
        $mpdf->Output();

        exit;
    }
}