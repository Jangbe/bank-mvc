<?php

function setFlash($name, $value, $type = 'success')
{
    $type = $type=='danger'?'error':'success';
    $_SESSION[$name] = ['message'=>$value, 'type'=>$type];
}

function getFlash($name, $closure)
{
    if(isset($_SESSION[$name])){
        $closure($_SESSION[$name]);
        unset($_SESSION[$name]);
    }
}

function redirect($url){
    header('location: '.BASE_URL.$url);
    exit;
}

function back()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

function abort($code = '404'){
    require_once __DIR__.'/../views/error/'.$code.'.php';
    exit;
}

function url($url = '')
{
    return BASE_URL.$url;
}

function transaksi($tr = null)
{
    $transaksi = [
        'setor' => 'Setor',
        'tarik' => 'Tarik',
        'tf'    => 'Transfer',
    ];
    return is_null($tr) ? $transaksi : $transaksi[$tr];
}

function user($index = ''){
    if(isset($_SESSION['user'][$index])){
        return $_SESSION['user'][$index];
    }else if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    }else{
        return [];
    }
}

function level($index)
{
    if(isset($_SESSION['nasabah'])){
        $index = $index=='id'?'id_nasabah':$index;
        $index = $index=='nama'?'nm_nasabah':$index;
        return $_SESSION['nasabah'][$index];
    }else if(isset($_SESSION['pegawai'])){
        $index = $index=='id'?'id_pegawai':$index;
        $index = $index=='nama'?'nm_pegawai':$index;
        return $_SESSION['pegawai'][$index];
    }
}

function rupiah($number){
    return "Rp. ".number_format($number, 0, ',', '.').",00";
}